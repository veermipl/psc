<?php

namespace App\Http\Controllers\Admin;

use App\Models\Business;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AnnulReportController extends Controller
{

    public function annual(){
        $this->authorize('resource');
        $data = Business::where('type', 'Annual_Reports')->orderby('id', 'desc')->get(); 
        return view('admin.annual.index', compact('data'));
    }
    public function annual_add()
    {
        $this->authorize('resource_view');
        return view('admin.annual.create');
    }
    public function annual_store(Request $request){
        $this->authorize('resource_create');
        $this->validate($request,[
            'title'     => 'required',
            'content'   => 'required',
            'status'    => 'required',
            'images'    => 'required|mimes:jpeg,jpg,png'
        ]);
        if ($request->hasFile('images')) {
            $file = $request->file('images');
            $profile = $file->store('/images/business', 'public');
        }
        $array = [
            'type' => 'Annual_Reports',
            'title' => $request->title ,
            'contant' => $request->content ,
            'image' => $profile ,
            'status' => $request->status,
        ];
        Business::create($array);
        return redirect()->route('admin.readines.annul')->with('status', 'Annual Reports Create successfully');
    }

    public function annual_status(Request $request){
        $this->authorize('resource_status_edit');
        $user = Business::find($request->uid);
        $status = $request->ustatus == 1 ? '0' : '1';
        DB::transaction(function () use ($user, $status) {
            $user->update([
                'status' => $status
            ]);
        });
        $data['error'] = false;
        $data['msg'] = 'Annual Reports status updated';
        return response()->json($data, 200);
    }
    public function annual_destroy($id){
        $user = Business::find($id);
        $user->delete();
        $data['error'] = false; 
        $data['msg'] = 'Annual Reports Deleted';
        return response()->json($data, 200);  
    }

    public function annual_edit($id){
        $data = Business::find($id); 
        return view('admin.annual.edit', compact('data'));
    }

    public function annual_update(Request $request, $id){
        $this->validate($request,[
            'title'     => 'required',
            'content'   => 'required',
            'status'    => 'required',
            'images'    => 'nullable|mimes:jpeg,jpg,png'
        ]);
        $test = Business::find($id);
        if ($request->hasFile('images')) {
            $file = $request->file('images');
            $profile = $file->store('/images/business', 'public');
        }else{
           $profile = $test->image;
        }
        $array = [
            'title' => $request->title ,
            'contant' => $request->content ,
            'image' => $profile ,
            'status' => $request->status,
        ];
        $test->Update($array);
        return redirect()->route('admin.readines.annul')->with('status', 'Annual Reports update successfully');

    }

    
}
