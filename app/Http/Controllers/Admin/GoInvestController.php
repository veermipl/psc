<?php

namespace App\Http\Controllers\Admin;

use App\Models\Business;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class GoInvestController extends Controller
{
    public function GoInves(Request $request){
        $this->authorize('resource');
        $main = Business::where('type', 'Go_Invest')->first();
        $top_partner = Business::where('type', 'Investment')->orderby('id', 'desc')->get(); 

        $data['tab'] = $request->filled('tab') ? $request->tab : 'main';
        $data['main'] = $main;
        $data['top_partner'] = $top_partner;
        return view('admin.goinvest.edit', $data);
    }

    public function GoInvest_update(Request $request){
        $this->authorize('resource_edit');
        $this->validate($request,[
            'title'  => 'required',
            'content'  => 'required',
            // 'status' => 'required',
            'images'  => 'nullable|mimes:jpeg,jpg,png',
        ]);
        $data = Business::where('type', $request->type)->first();
        // dd($data);
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
            'status' => $request->status ?? '1',
            'type'  => $request->type
        ];
        if($data != ''){
        $data->Update($array);
        }else
        {
            Business::create($array);
        }
        return redirect()->route('admin.readines.goinvest')->with('status', 'go inves update successfully');
    }


    // public function Investment(){
    //     $data = Business::where('type', 'Investment')->orderby('id', 'desc')->get(); 
    //     return view('admin.investment.index', compact('data'));
    // }

    public function Investment_add()
    {
        return view('admin.investment.create');
    }
    public function Investment_store(Request $request){
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
            'type' => 'Investment',
            'title' => $request->title ,
            'contant' => $request->content ,
            'image' => $profile ,
            'status' => $request->status,
        ];
        Business::create($array);
        return redirect()->route('admin.readines.goinvest', ['tab' => $request->type])->with('status', 'Investment Create successfully');
    }

    public function Investment_status(Request $request){
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
    public function Investment_destroy(Request $request){
        $user = Business::find($request->lid);
        $user->delete();
        $data['error'] = false; 
        $data['msg'] = 'Investment Deleted';
        return response()->json($data, 200);  
    }

    public function Investment_edit($id){
        $data = Business::find($id); 

        return view('admin.investment.edit', compact('data'));
    }

    public function Investment_update(Request $request, $id){
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
        return redirect()->route('admin.readines.goinvest', ['tab' => $request->type])->with('status', 'Investment update successfully');

    }

}
