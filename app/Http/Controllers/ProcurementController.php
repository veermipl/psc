<?php

namespace App\Http\Controllers;

use App\Models\Business;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProcurementController extends Controller
{

    public function procurement(){
        $data = Business::where('type', 'Procurement')->first();
        return view('admin.procurement.edit', compact('data'));
    }

    public function procurement_update(Request $request, $id){
        $this->validate($request,[
            'title'  => 'required',
            'content'  => 'required',
            'status' => 'required',
            'images'  => 'nullable|mimes:jpeg,jpg,png',
        ]);
        $data = Business::find($id);
        if ($request->hasFile('images')) {
            $file = $request->file('images');
            $profile = $file->store('/images/business', 'public');
        }else{
            $profile=  $data->image;
        }
        $array = [
            'title' => $request->title ,
            'contant' => $request->content ,
            'image' => $profile,
            'status' => $request->status,
        ];
        $data->Update($array);
        return redirect()->route('admin.readines.procurement')->with('status', 'Procurement Process in Guyana update successfully');
    }
    

    public function methods(){
        $data = Business::where('type', 'Procurement_methods')->orderby('id', 'desc')->get(); 
        return view('admin.methods.index', compact('data'));
    }
    public function methods_add()
    {
        return view('admin.methods.create');
    }
    public function methods_store(Request $request){

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
            'type' => 'Procurement_methods',
            'title' => $request->title ,
            'contant' => $request->content ,
            'image' => $profile ,
            'status' => $request->status,
        ];
        Business::create($array);
        return redirect()->route('admin.readines.methods')->with('status', 'Methods Create successfully');
    }

    public function methods_status(Request $request){
        $user = Business::find($request->uid);
        $status = $request->ustatus == 1 ? '0' : '1';
        DB::transaction(function () use ($user, $status) {
            $user->update([
                'status' => $status
            ]);
        });
        $data['error'] = false;
        $data['msg'] = 'Methods status updated';
        return response()->json($data, 200);
    }
    public function methods_destroy($id){
        $user = Business::find($id);
        $user->delete();
        $data['error'] = false; 
        $data['msg'] = 'Methods Deleted';
        return response()->json($data, 200);  
    }

    public function methods_edit($id){
        $data = Business::find($id); 

        return view('admin.methods.edit', compact('data'));
    }

    public function methods_update(Request $request, $id){
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
        return redirect()->route('admin.readines.methods')->with('status', 'Methods update successfully');

    }




    public function methods_services(){
        $data = Business::where('type', 'Procurement_services')->orderby('id', 'desc')->get(); 
        return view('admin.serves.index', compact('data'));
    }
    public function methods_services_add()
    {
        return view('admin.serves.create');
    }
    public function methods_services_store(Request $request){

        $this->validate($request,[
            'title'     => 'required',
            'content'   => 'required',
            'status'    => 'required',
            'images'    => 'nullable|mimes:jpeg,jpg,png'
        ]);
        if ($request->hasFile('images')) {
            $file = $request->file('images');
            $profile = $file->store('/images/business', 'public');
        }
        $array = [
            'type' => 'Procurement_services',
            'title' => $request->title ,
            'contant' => $request->content ,
            'image' => $profile ?? '' ,
            'status' => $request->status,
        ];
        Business::create($array);
        return redirect()->route('admin.readines.services')->with('status', 'Services Create successfully');
    }

    public function methods_services_status(Request $request){
        $user = Business::find($request->uid);
        $status = $request->ustatus == 1 ? '0' : '1';
        DB::transaction(function () use ($user, $status) {
            $user->update([
                'status' => $status
            ]);
        });
        $data['error'] = false;
        $data['msg'] = 'Services status updated';
        return response()->json($data, 200);
    }
    public function methods_services_destroy($id){
        $user = Business::find($id);
        $user->delete();
        $data['error'] = false; 
        $data['msg'] = 'Services Deleted';
        return response()->json($data, 200);  
    }

    public function methods_services_edit($id){
        $data = Business::find($id); 

        return view('admin.serves.edit', compact('data'));
    }

    public function methods_services_update(Request $request, $id){
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
        return redirect()->route('admin.readines.services')->with('status', 'Services update successfully');

    }
}