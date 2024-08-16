<?php

namespace App\Http\Controllers\Admin;

use App\Models\Business;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class IDBInvestController extends Controller
{
    public function idb_inves(){
        $data = Business::where('type', 'IDBInvest')->first();
        return view('admin.invest.edit', compact('data'));
    }

    public function inves_update(Request $request, $id){
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
        return redirect()->route('admin.readines.idbinves')->with('status', 'IDB Invest update successfully');
    }



    public function key_areas(){
        $data = Business::where('type', 'key_areas')->orderby('id', 'desc')->get(); 
        return view('admin.areas.index', compact('data'));
    }
    public function areas_add()
    {
        return view('admin.areas.create');
    }
    public function areas_store(Request $request){

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
            'type' => 'key_areas',
            'title' => $request->title ,
            'contant' => $request->content ,
            'image' => $profile ,
            'status' => $request->status,
        ];
        Business::create($array);
        return redirect()->route('admin.readines.key_areas')->with('status', 'Investment Create successfully');
    }

    public function areas_status(Request $request){
        $user = Business::find($request->uid);
        $status = $request->ustatus == 1 ? '0' : '1';
        DB::transaction(function () use ($user, $status) {
            $user->update([
                'status' => $status
            ]);
        });
        $data['error'] = false;
        $data['msg'] = 'Investment status updated';
        return response()->json($data, 200);
    }
    public function areas_destroy($id){
        $user = Business::find($id);
        $user->delete();
        $data['error'] = false; 
        $data['msg'] = 'Investment Deleted';
        return response()->json($data, 200);  
    }

    public function areas_edit($id){
        $data = Business::find($id); 

        return view('admin.areas.edit', compact('data'));
    }

    public function areas_update(Request $request, $id){
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
        return redirect()->route('admin.readines.key_areas')->with('status', 'Key Areas of Focus update successfully');

    }




    public function IDB_Investment(){
        $data = Business::where('type', 'idb_investment')->orderby('id', 'desc')->get(); 
        return view('admin.idb.index', compact('data'));
    }
    public function idb_investment_add()
    {
        return view('admin.idb.create');
    }
    public function idb_investment_store(Request $request){

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
            'type' => 'idb_investment',
            'title' => $request->title ,
            'contant' => $request->content ,
            'image' => $profile ?? '',
            'status' => $request->status,
        ];
        Business::create($array);
        return redirect()->route('admin.readines.IDB_Investment')->with('status', 'Create IDB Investment Services successfully');
    }

    public function idb_investment_status(Request $request){
        $user = Business::find($request->uid);
        $status = $request->ustatus == 1 ? '0' : '1';
        DB::transaction(function () use ($user, $status) {
            $user->update([
                'status' => $status
            ]);
        });
        $data['error'] = false;
        $data['msg'] = 'Investment status updated';
        return response()->json($data, 200);
    }
    public function idb_investment_destroy($id){

        $user = Business::find($id);
        $user->delete();
        $data['error'] = false; 
        $data['msg'] = 'IDB Investment Services Deleted';
        return response()->json($data, 200);  
    }

    public function idb_investment_edit($id){
        $data = Business::find($id); 

        return view('admin.idb.edit', compact('data'));
    }

    public function idb_investment_update(Request $request, $id){
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
        return redirect()->route('admin.readines.IDB_Investment')->with('status', 'IDB Investment Services update successfully');

    }


}
