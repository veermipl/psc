<?php

namespace App\Http\Controllers;

use App\Models\Business;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProcurementController extends Controller
{

    public function procurement(Request $request){
        $this->authorize('resource');
        $main = Business::where('type', 'Procurement')->first();
        $top_partner = Business::where('type', 'Procurement_methods')->orderby('id', 'desc')->get(); 
        $top_country = Business::where('type', 'Procurement_services')->orderby('id', 'desc')->get(); 

        $data['tab'] = $request->filled('tab') ? $request->tab : 'main';
        $data['main'] = $main;
        $data['top_partner'] = $top_partner;
        $data['top_country'] = $top_country;

        return view('admin.procurement.edit', $data);
    }

    public function procurement_update(Request $request){
        $this->authorize('resource_edit');
        $this->validate($request,[
            'title'  => 'required',
            'content'  => 'required',
            // 'status' => 'required',
            'images'  => 'nullable|mimes:jpeg,jpg,png',
        ]);
        $data = Business::where('type', $request->type)->first();

        if ($request->hasFile('images')) {
            $file = $request->file('images');
            $profile = $file->store('/images/business', 'public');
        }else{
            $profile=  $data->image ?? '';
        }
        $array = [
            'title' => $request->title ,
            'contant' => $request->content ,
            'image' => $profile,
            'status' => $request->status ?? '1',
            'type' => $request->type,
        ];
        if($data != ''){
        $data->Update($array);
        }else{
            Business::create($array);
        }
        return redirect()->route('admin.readines.procurement')->with('status', 'Procurement Process in Guyana update successfully');
    }
    

    // public function methods(){
    //     $data = Business::where('type', 'Procurement_methods')->orderby('id', 'desc')->get(); 
    //     return view('admin.methods.index', compact('data'));
    // }
    public function methods_add()
    {
        $this->authorize('resource_crate');
        return view('admin.methods.create');
    }
    public function methods_store(Request $request){
        $this->authorize('resource_crate');
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
        return redirect()->route('admin.readines.procurement',['tab' => $request->type] )->with('status', 'Methods Create successfully');
    }

    public function methods_status(Request $request){
        $this->authorize('resource_status_edit');
        $user = Business::find($request->lid);
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
    public function methods_destroy(Request $request){
        $this->authorize('resource_delete');
        $user = Business::find($request->lid);
        $user->delete();
        $data['error'] = false; 
        $data['msg'] = 'Methods Deleted';
        return response()->json($data, 200);  
    }

    public function methods_edit($id){
        $this->authorize('resource_edit');
        $data = Business::find($id); 
        return view('admin.methods.edit', compact('data'));
    }

    public function methods_update(Request $request, $id){
        $this->authorize('resource_edit');
        // dd($request->all());
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
        return redirect()->route('admin.readines.procurement',['tab' => $request->type] )->with('status', 'Methods update successfully');

    }



    public function methods_services_add()
    {
        $this->authorize('resource_create');
        return view('admin.serves.create');
    }
    public function methods_services_store(Request $request){
        $this->authorize('resource_create');
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
        return redirect()->route('admin.readines.procurement',['tab' => $request->type])->with('status', 'Services Create successfully');
    }

    public function methods_services_status(Request $request){
        $this->authorize('resource_status_edit');
        $user = Business::find($request->lid);
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
    public function methods_services_destroy(Request $request){
        $this->authorize('resource_delete');
        // dd($request->all());
        $user = Business::find($request->lid);
        $user->delete();
        $data['error'] = false; 
        $data['msg'] = 'Services Deleted';
        return response()->json($data, 200);  
    }

    public function methods_services_edit($id){
        $this->authorize('resource_edit');
        $data = Business::find($id); 

        return view('admin.serves.edit', compact('data'));
    }

    public function methods_services_update(Request $request, $id){
        $this->authorize('resource_edit');
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
        return redirect()->route('admin.readines.procurement',['tab' => $request->type])->with('status', 'Services update successfully');

    }
}