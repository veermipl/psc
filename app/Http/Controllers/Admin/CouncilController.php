<?php

namespace App\Http\Controllers\admin;

use App\Models\Council;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;

class CouncilController extends Controller
{
    public function index (Request $request){
        $this->authorize('resource');

        $filterValues = [
            'name' => $request->name ?? null,
            'status' => $request->status ?? null,
        ];
        $list = Council::orderBy('name', 'asc')
            ->where(function (Builder $query) use ($filterValues, $request) {
                $query->when($request->filled('name'), function (Builder $q) use ($filterValues) {
                    $q->where('name', 'like', '%' . $filterValues['name'] . '%');
                })
                    ->when($request->filled('status'), function (Builder $q) use ($filterValues) {
                        $q->where('status', $filterValues['status']);
                    });
            })
            ->get();

        $data['filterValues'] = $filterValues;
        $data['data'] = $list;

        // dd($data);
        // return view('admin.membership.type.index', $data);
        return view('admin.about.council.index', $data);

    }

    public function create(){
        return view('admin.about.council.craete');
    }

    public function store (Request $request){
        $this->validate($request, [
            'name'     => 'required',
            // 'designattion'   => 'required',
            'status'    => 'required',
            'profile'    => 'required|mimes:jpeg,jpg,png'
        ]);

        if ($request->hasFile('profile')) {
            $file = $request->file('profile');
            $image = $file->store('/images/business', 'public');
        }

        $array = [
            'name' => $request->name,
            'designattion' => $request->designattion,
            'image' => $image,
            'status' => $request->status,
        ];
        Council::create($array);
        return redirect()->route('admin.council.index')->with('status', 'Council Create successfully');
    }

    public function status(Request $request)
    {
        $this->authorize('membership_status_edit');
        // $validated = $request->validated();
        $typeData = Council::find($request['uid']);
        $status = $request['ustatus'] == 1 ? '0' : '1';

        DB::transaction(function () use ($typeData, $status) {
            $typeData->update([
                'status' => $status
            ]);
        });

        $data['error'] = false;
        $data['msg'] = 'Status updated';
 
        return response()->json($data, 200);
    }
    
    public function edit($id){
       $data = Council::find($id);
        return view('admin.about.council.edit', compact('data'));

    } 

    public function update(Request $request, $id){
        $this->authorize('resource_edit');

        $this->validate($request, [
            'name'     => 'required',
            // 'designattion'   => 'required',
            'status'    => 'required',
            'image'    => 'nullable|mimes:jpeg,jpg,png'
        ]);
        $test = Council::find($id);
        if ($request->hasFile('images')) {
            $file = $request->file('images');
            $profile = $file->store('/images/business', 'public');
        } else {
            $profile = $test->image;
        }

        $array = [
            'title' => $request->title,
            'contant' => $request->content,
            'image' => $profile,
            'status' => $request->status,
        ];
        $test->Update($array);

        return redirect()->route('admin.council.index')->with('status', 'Council update successfully');
    }

    public function destroy($uid)
    {
        $this->authorize('membership_delete');
        $user = Council::find($uid);
        $user->delete();
        $data['error'] = false;
        $data['msg'] = 'Council type Deleted';

        // return redirect()->route('admin.council.index')->with('status', 'Council type Deleted');
        return response()->json($data, 200);
    }


}
