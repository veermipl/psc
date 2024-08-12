<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function Council(){
        $data= About::where('type', 'Council')->first();
        return view('admin.about.council', compact('data'));
    }
    public function Council_update(Request $request, $id){
        $this->validate($request,[
            'title'  => 'required',
            'content'  => 'required',
            'status' => 'required'
        ]);
        $data = About::find($id);
        if ($request->hasFile('images')) {
            $file = $request->file('images');
            $profile = $file->store('/images/team', 'public');
        }else{
            $profile=  $data->image;
        }
        $array = [
            'title' => $request->title ,
            'contant' => $request->content ,
            'image' => $profile ,
            'status' => $request->status,
        ];
        $data->Update($array);
        return redirect()->route('admin.about.council')->with('status', 'Council update successfully');
    }

    public function History(){
        $data= About::where('type', 'History')->first();
        return view('admin.about.history', compact('data'));
    }

    public function History_update(Request $request, $id){
        $this->validate($request,[
            'title'  => 'required',
            'content'  => 'required',
            'status' => 'required'
        ]);
        $data = About::find($id);
        if ($request->hasFile('images')) {
            $file = $request->file('images');
            $profile = $file->store('/images/team', 'public');
        }else{
            $profile=  $data->image;
        }
        $array = [
            'title' => $request->title ,
            'contant' => $request->content ,
            'image' => $profile ,
            'status' => $request->status,
        ];
        $data->Update($array);
        return redirect()->route('admin.about.history')->with('status', 'History update successfully');
    }

}
