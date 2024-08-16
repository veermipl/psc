<?php

namespace App\Http\Controllers\Admin;

use App\Models\CoreValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class CoreValueController extends Controller
{
    public function Index(){

        $data = CoreValue::orderby('id', 'desc')->get();
        return view('admin.core.index', compact('data'));
        // dd('ok');
    }
    public function add(){
        return view ('admin.core.create');
    }

    public function store(Request $request){
        $this->validate($request,[
            'title'     => 'required',
            'status'    => 'required',
            'images'    => 'nullable|mimes:jpeg,jpg,png'
        ]);
        if ($request->hasFile('images')) {
            $file = $request->file('images');
            $profile = $file->store('/images/cms', 'public');
        }
        $array = [
            'title' => $request->title ,
            'contant' => $request->content ?? '' ,
            'image' => $profile ?? '',
            'status' => $request->status,
        ];
        CoreValue::create($array);
        return redirect()->route('admin.cms.corevalue')->with('status', 'Core value create successfully');
    }


    public function status(Request $request) {
        $user = CoreValue::find($request->uid);
        $status = $request->ustatus == 1 ? '0' : '1';
        DB::transaction(function () use ($user, $status) {
            $user->update([
                'status' => $status
            ]);
        });
        $data['error'] = false;
        $data['msg'] = 'Core value status updated';
        return response()->json($data, 200);
    }

    public function destroy(Request $request, $id){
        $user = CoreValue::find($id);
        $user->delete();
        $data['error'] = false; 
        $data['msg'] = 'Performance Deleted';
        return response()->json($data, 200);  
    }

    public function edit($id){
        $data = CoreValue::find($id);
        return view('admin.core.edit', compact('data'));

    }
    public function Update(Request $request, $id){

        $this->validate($request,[
            'title'     => 'required',
            'status'    => 'required',
            'images'    => 'nullable|mimes:jpeg,jpg,png'
        ]);
        $data = CoreValue::find($id);
        if ($request->hasFile('images')) {
            $file = $request->file('images');
            $profile = $file->store('/images/cms', 'public');
        }else{
            $profile = $data->image;
        }
        $array = [
            'title' => $request->title ,
            // 'contant' => $request->content ,
            'image' => $profile ,
            'status' => $request->status,
        ];
        $data->Update($array);
        return redirect()->route('admin.cms.corevalue')->with('status', 'core value update successfully');

    }
}
