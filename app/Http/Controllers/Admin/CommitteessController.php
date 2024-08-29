<?php

namespace App\Http\Controllers\Admin;

use App\Models\Committeess;
use App\Traits\ImageTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class CommitteessController extends Controller
{
    use  ImageTraits;
    public function create(){

        return view('admin.committeess.create');
    }
    public function store(Request $request){

        // dd($request->all());
        $this->validate($request,[
            'name'  => 'required',
            'office'  => 'required',
            'profile'  => 'required',
            'profile'  => 'required|mimes:jpeg,jpg,png',
            'status' => 'required'
            
        ]);

        // $profile = null;
        if ($request->hasFile('profile')) {
            $file = $request->file('profile');
            $profile = $file->store('/images/team', 'public');
        }

        $create = [
            'name' => $request->name ?? '',
            // 'email' => $request->status ?? '',
            'office' => $request->office ?? '',
            'facebook' => $request->facebook ?? '',
            'twitter' => $request->twitter ?? '',
            'instra' => $request->instagram ?? '',
            'dribbble' => $request->dribbble ??'',
            'status' => $request->status,
            'image' => $profile ?? '',
        ];
        Committeess::create($create);
        return redirect()->route('admin.committeess.list')->withSuccess('Committeess create successfully!');
    }

    public function list(){
        $data = Committeess::where('deleted_at', '0')->orderby('id', 'desc')->get();
        return view('admin.committeess.index', compact('data'));

    }

    public function status(Request $request) {
        $user = Committeess::find($request->uid);
        $status = $request->lstatus == 1 ? '0' : '1';

        DB::transaction(function () use ($user, $status) {
            $user->update([
                'status' => $status
            ]);
        });
        $data['error'] = false;
        $data['msg'] = 'Committeess status updated';

        return response()->json($data, 200);
    }

    public function destroy(Request $request, $id){
        $user = Committeess::find($id);

        $user->delete();
        $data['error'] = false; 
        $data['msg'] = 'committeess Deleted';

        return response()->json($data, 200);  
    }

    public function edit($id) {
    $data = Committeess::find($id);
        return view('admin.committeess.edit', compact('data'));
    }

    public function Update (Request $request, $id){

        // dd($request->all());
        $this->validate($request,[
            'name'  => 'required',
            'office'  => 'required',
            // 'profile'  => 'required',
            'status' => 'required',
            'profile'  => 'nullable|mimes:jpeg,jpg,png',
        ]);
        $staff = Committeess::find($id);
        if ($request->hasFile('profile')) {
            $file = $request->file('profile');
            $profile = $file->store('/images/team', 'public');
        }else{
            $profile=  $staff->image;
        }
        $array = [
            'name' => $request->name ,
            // 'email' => $request->status ?? '',
            'office' => $request->office ,
            'facebook' => $request->facebook ,
            'twitter' => $request->twitter ,
            'instra' => $request->instagram ,
            'dribbble' => $request->dribbble ,
            'status' => $request->status,
            'image' => $profile,
        ];
        $staff->Update($array);
        return redirect()->route('admin.committeess.list')->with('status', 'Committeess update successfully');
    }

    
}
