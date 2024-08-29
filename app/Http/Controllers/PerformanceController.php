<?php

namespace App\Http\Controllers;

use App\Models\Performance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PerformanceController extends Controller
{
    public function Index(){

        $data = Performance::orderby('id', 'desc')->get();
        return view('admin.performance.index', compact('data'));
        // dd('ok');
    }
    public function add_performance(){
        return view ('admin.performance.create');

    }
    public function store_performance(Request $request){
        $this->validate($request,[
            'title'     => 'required',
            'content'   => 'required',
            'status'    => 'required',
            'images'    => 'required|mimes:jpeg,jpg,png'
        ]);
        if ($request->hasFile('images')) {
            $file = $request->file('images');
            $profile = $file->store('/images/cms', 'public');
        }
        $array = [
            'title' => $request->title ,
            'contant' => $request->content ,
            'image' => $profile ,
            'status' => $request->status,
            'type'  => 'performance_driverss'
        ];
        Performance::create($array);
        return redirect()->route('admin.about.introduction',['tab' => $request->type])->with('status', 'Performance Create successfully');
    }


    public function status(Request $request) {
        $user = Performance::find($request->lid);
        $status = $request->lstatus == 1 ? '0' : '1';
        DB::transaction(function () use ($user, $status) {
            $user->update([
                'status' => $status
            ]);
        });
        $data['error'] = false;
        $data['msg'] = 'Performance status updated';
        return response()->json($data, 200);
    }

    public function destroy(Request $request){
        $user = Performance::find($request->lid);
        $user->delete();
        $data['error'] = false; 
        $data['msg'] = 'Performance Deleted';
        return response()->json($data, 200);  
    }

    public function edit($id){
        $data = Performance::find($id);
        return view('admin.performance.edit', compact('data'));

    }
    public function Update(Request $request, $id){

        $this->validate($request,[
            'title'     => 'required',
            'content'   => 'required',
            'status'    => 'required',
            'images'    => 'nullable|mimes:jpeg,jpg,png'
        ]);
        $data = Performance::find($id);
        if ($request->hasFile('images')) {
            $file = $request->file('images');
            $profile = $file->store('/images/cms', 'public');
        }else{
            $profile = $data->image;
        }
        $array = [
            'title' => $request->title ,
            'contant' => $request->content ,
            'image' => $profile ,
            'status' => $request->status,
        ];
        $data->Update($array);
        return redirect()->route('admin.about.introduction',['tab' => $request->type])->with('status', 'Performance update successfully');

    }

}
