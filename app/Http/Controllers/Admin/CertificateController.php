<?php

namespace App\Http\Controllers\Admin;

use App\Models\Business;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class CertificateController extends Controller
{

    public function certificate(){
        $data = Business::where('type', 'Origins')->first();
        return view('admin.origins.edit', compact('data'));
    }

    public function certificate_update(Request $request){

        $this->validate($request,[
            'title'  => 'required',
            'content'  => 'required',
            'status' => 'required',
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
            'status' => $request->status,
            'type' => $request->type,
        ];
        if($data != ''){
        $data->Update($array);
        }else{
            Business::create($array);
        }
        return redirect()->route('admin.readines.certificate.origins')->with('status', 'Certificate of Origins update successfully');
    }

    public function type_certificate(){
        $data = Business::where('type', 'Origins_certificate')->orderby('id', 'desc')->get(); 
        return view('admin.origins.type.index', compact('data'));
    }
    public function type_add()
    {
        return view('admin.origins.type.create');
    }
    public function type_store(Request $request){

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
            'type' => 'Origins_certificate',
            'title' => $request->title ,
            'contant' => $request->content ,
            'image' => $profile ,
            'status' => $request->status,
        ];
        Business::create($array);
        return redirect()->route('admin.readines.origins.type.certificate')->with('status', 'Type certificate create successfully');
    }

    public function type_status(Request $request){
        $user = Business::find($request->uid);
        $status = $request->ustatus == 1 ? '0' : '1';
        DB::transaction(function () use ($user, $status) {
            $user->update([
                'status' => $status
            ]);
        });
        $data['error'] = false;
        $data['msg'] = 'Certificates status updated';
        return response()->json($data, 200);
    }
    public function type_destroy($id){
        $user = Business::find($id);
        $user->delete();
        $data['error'] = false; 
        $data['msg'] = 'Certificate Deleted';
        return response()->json($data, 200);  
    }

    public function type_edit($id){
        $data = Business::find($id); 

        return view('admin.origins.type.edit', compact('data'));
    }

    public function type_update(Request $request, $id){
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
        return redirect()->route('admin.readines.origins.type.certificate')->with('status', 'certificate update successfully');

    }


    public function certificatess(){
        $data = Business::where('type', 'Origins_certificates')->orderby('id', 'desc')->get(); 
        return view('admin.origins.certificate.index', compact('data'));
    }
    public function origins_add() {
        return view('admin.origins.certificate.create');
    }

    public function origins_store(Request $request){
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
            'type' => 'Origins_certificates',
            'title' => $request->title ,
            'contant' => $request->content ,
            'image' => $profile ?? '' ,
            'status' => $request->status,
        ];
        Business::create($array);
        return redirect()->route('admin.readines.origins.certificate')->with('status', 'Type certificate create successfully');
    }
    

    public function origins_status(Request $request){
        $user = Business::find($request->uid);
        $status = $request->ustatus == 1 ? '0' : '1';
        DB::transaction(function () use ($user, $status) {
            $user->update([
                'status' => $status
            ]);
        });
        $data['error'] = false;
        $data['msg'] = 'certificates status updated';
        return response()->json($data, 200);
    }
    public function origins_destroy($id){
        $user = Business::find($id);
        $user->delete();
        $data['error'] = false; 
        $data['msg'] = 'certificates Deleted';
        return response()->json($data, 200);  
    }

    public function origins_edit($id){
        $data = Business::find($id); 

        return view('admin.origins.certificate.edit', compact('data'));
    }

    public function origins_update(Request $request, $id){
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
        return redirect()->route('admin.readines.origins.certificate')->with('status', 'certificate update successfully');

    }


}
