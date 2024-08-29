<?php

namespace App\Http\Controllers\Admin;

use App\Models\Business;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class IDBInvestController extends Controller
{
    public function idb_inves(Request $request){
        $this->authorize('resource');
        $main = Business::where('type', 'IDBInvest')->first();
        $top_partner = Business::where('type', 'key_areas')->orderby('id', 'desc')->get(); 
        $top_country = Business::where('type', 'idb_investment')->orderby('id', 'desc')->get(); 

        $data['tab'] = $request->filled('tab') ? $request->tab : 'main';
        $data['main'] = $main;
        $data['top_partner'] = $top_partner;
        $data['top_country'] = $top_country;

        return view('admin.invest.edit', $data);
    }

    public function inves_update(Request $request){
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
            'type'  => $request->type,
        ];
        if($data  != ''){
        $data->Update($array);
        }else{
            Business::create($array);
        }
        return redirect()->route('admin.readines.idbinves')->with('status', 'IDB Invest update successfully');
    }



    // public function key_areas(){
    //     $data = Business::where('type', 'key_areas')->orderby('id', 'desc')->get(); 
    //     return view('admin.areas.index', compact('data'));
    // }

    public function areas_add()
    {
        $this->authorize('resource_view');
        return view('admin.areas.create');
    }

    public function areas_store(Request $request){
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
            'type' => 'key_areas',
            'title' => $request->title ,
            'contant' => $request->content ,
            'image' => $profile ,
            'status' => $request->status,
        ];
        Business::create($array);
        return redirect()->route('admin.readines.idbinves', ['tab' => $request->type])->with('status', 'Investment Create successfully');
    }

    public function areas_status(Request $request){
        $this->authorize('resource_status_edit');
        $user = Business::find($request->lid);
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
    public function areas_destroy(Request $request){
        $this->authorize('resource_delete');
        $user = Business::find($request->lid);
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
        return redirect()->route('admin.readines.idbinves', ['tab' => $request->type])->with('status', 'Key Areas of Focus update successfully');

    }




    // public function IDB_Investment(){
    //     $data = Business::where('type', 'idb_investment')->orderby('id', 'desc')->get(); 
    //     return view('admin.idb.index', compact('data'));
    // }
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
        return redirect()->route('admin.readines.idbinves', ['tab' => $request->type])->with('status', 'Create IDB Investment Services successfully');
    }

    public function idb_investment_status(Request $request){
        $user = Business::find($request->lid);
        $status = $request->lstatus == 1 ? '0' : '1';
        DB::transaction(function () use ($user, $status) {
            $user->update([
                'status' => $status
            ]);
        });
        $data['error'] = false;
        $data['msg'] = 'Investment status updated';
        return response()->json($data, 200);
    }
    public function idb_investment_destroy(Request $request){

        $user = Business::find($request->lid);
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
        return redirect()->route('admin.readines.idbinves', ['tab' => $request->type])->with('status', 'IDB Investment Services update successfully');

    }


}
