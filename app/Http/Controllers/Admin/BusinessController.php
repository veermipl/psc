<?php

namespace App\Http\Controllers\Admin;

use App\Models\Business;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class BusinessController extends Controller
{

    public function business(Request $request){
        $this->authorize('resource');

        $main = Business::where('type', 'Business')->first();
        $top_partner = Business::where('type', 'Business_certificate')->orderby('id', 'desc')->get(); 
        $top_country = Business::where('type', 'Business_benefits')->orderby('id', 'desc')->get(); 
        $data['tab'] = $request->filled('tab') ? $request->tab : 'main';
        $data['main'] = $main;
        $data['top_partner'] = $top_partner;
        $data['top_country'] = $top_country;
       
        return view('admin.business.edit', $data);
    }

    public function business_update(Request $request){
        $this->authorize('resource_edit');

        $this->validate($request,[
            'title'  => 'required',
            'content'  => 'required',
            'images'  => 'nullable|mimes:jpeg,jpg,png',
        ]);
        $data = Business::where('type', $request->type);
        if ($request->hasFile('images')) {
            $file = $request->file('images');
            $profile = $file->store('/images/business', 'public');
        }else{
            $profile=  $data->image ?? '';
        }
        $array = [
            'title' => $request->title ,
            'contant' => $request->content ,
            'image' => $profile ,
            'status' => '1',
            'type'   =>$request->type,
        ];
        if($data != ''){
        $data->Update($array);
        }else{
            Business::create($array);
        }
        return redirect()->route('admin.readines.business')->with('status', 'Business readiness desk update successfully');
    }


    public function certificate_add()
    {
        $this->authorize('resource_create');

        return view('admin.certificate.create');
    }
    public function certificate_store(Request $request){
        // dd('jkkjkj');
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
            'type' => 'Business_certificate',
            'title' => $request->title ,
            'contant' => $request->content ,
            'image' => $profile ,
            'status' => $request->status,
        ];
        Business::create($array);
        return redirect()->route('admin.readines.business', ['tab' => $request->type])->with('status', 'Certificate Create successfully');

    }

    public function certificate_status(Request $request){
        $this->authorize('resource_status_edit');

        $user = Business::find($request->lid);
        $status = $request->lstatus == 1 ? '0' : '1';
        DB::transaction(function () use ($user, $status) {
            $user->update([
                'status' => $status
            ]);
        });
        $data['error'] = false;
        $data['msg'] = 'Certificate status updated';
        return response()->json($data, 200);
    }

    public function certificate_destroy(Request $request){
        $this->authorize('resource_delete');
        // dd($request->all());

        $user = Business::find($request->lid);
        $user->delete();
        $data['error'] = false; 
        $data['msg'] = 'Certificate Deleted';
        return response()->json($data, 200);  
    }

    public function certificate_edit($id){
        $this->authorize('resource_edit');

        $data = Business::find($id); 

        return view('admin.certificate.edit', compact('data'));
    }

    public function certificate_update(Request $request, $id){
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
        return redirect()->route('admin.readines.business', ['tab' => $request->type])->with('status', 'Certificate update successfully');
    }

    // public function benefits(){
    //     $data = Business::where('type', 'Business_benefits')->orderby('id', 'desc')->get(); 
    //     return view('admin.benefits.index', compact('data'));
    // }
    public function benefits_add()
    {
        $this->authorize('resource_create');

        return view('admin.benefits.create');
    }
    public function benefits_store(Request $request){
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
            'type' => 'Business_benefits',
            'title' => $request->title ,
            'contant' => $request->content ,
            'image' => $profile ?? '',
            'status' => $request->status,
        ];
        Business::create($array);
        return redirect()->route('admin.readines.business', ['tab' => $request->type])->with('status', 'Benefits of certificate Create successfully');

    }

    public function benefits_status(Request $request){
        $this->authorize('resource_status_edit');

        $user = Business::find($request->lid);
        $status = $request->ustatus == 1 ? '0' : '1';
        DB::transaction(function () use ($user, $status) {
            $user->update([
                'status' => $status
            ]);
        });
        $data['error'] = false;
        $data['msg'] = 'Benefits of certificate status updated';
        return response()->json($data, 200);
    }
    public function benefits_destroy(Request $request){
        $this->authorize('resource_delete');

        $user = Business::find($request->lid);
        $user->delete();
        $data['error'] = false; 
        $data['msg'] = 'Benefits of certificate Deleted';
        return response()->json($data, 200);  
    }

    public function benefits_edit($id){
        $this->authorize('resource_edit');

        $data = Business::find($id); 

        return view('admin.benefits.edit', compact('data'));
    }

    public function benefits_update(Request $request, $id){
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
        return redirect()->route('admin.readines.business', ['tab' => $request->type])->with('status', 'Benefits of certificate update successfully');

    }


}