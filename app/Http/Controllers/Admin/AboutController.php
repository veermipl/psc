<?php

namespace App\Http\Controllers\Admin;

use App\Models\About;
use App\Models\CoreValue;
use App\Models\Performance;
use App\Models\Testimonials;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AboutController extends Controller
{

    public function Introduction(Request $request){
        $this->authorize('about_us');

        $About = About::where('type', 'About')->first();
        $top_mission= About::where('type', 'Mission')->first();
        $top_partner = CoreValue::orderby('id', 'desc')->get(); 
        $strategic = Testimonials::orderby('id', 'desc')->get(); 
        $top_country =  Performance::orderby('id', 'desc')->get();
        $data['tab'] = $request->filled('tab') ? $request->tab : 'About';
        $data['About'] = $About;
        $data['mission'] = $top_mission;
        $data['strategic'] = $strategic;
        $data['top_partner'] = $top_partner;
        $data['top_country'] = $top_country;

        return view('admin.about.introduction', $data);
    }


    public function Introduction_update(Request $request){
        $this->authorize('about_us_edit');
        $this->validate($request,[
            'title'  => 'required',
            'content'  => 'required',
            'images'  => 'nullable|mimes:jpeg,jpg,png',
            // 'status' => 'required'
        ]);

        $data = About::where('type' ,$request->type)->first();


        if ($request->hasFile('images')) {
            $file = $request->file('images');
            $profile = $file->store('/images/team', 'public');
        }else{
            $profile=  $data->image ?? '';
        }
        $array = [
            'title' => $request->title ,
            'contant' => $request->content ,
            'image' => $profile ,
            'status' => $request->status ?? '1',
            'type'  => $request->type,
        ];
        if($data != ''){
        $data->Update($array);
        }else{
            About::create($array);
        }
        return redirect()->route('admin.about.introduction')->with('status', 'Introduction update successfully');
    }

    public function Council(Request $request){   
        $this->authorize('about_us');
        $About = About::where('type', 'Council')->first();
        $data['tab'] = $request->filled('tab') ? $request->tab : 'About';
        $data['About'] = $About;
        return view('admin.about.council', $data);
    }

    public function Council_update(Request $request){
        $this->authorize('about_us_edit');
        $this->validate($request,[
            'title'  => 'required',
            'content'  => 'required',
            // 'status' => 'required',
            'images'  => 'nullable|mimes:jpeg,jpg,png',
        ]);

        $data = About::where('type' ,$request->type)->first();

        if ($request->hasFile('images')) {
            $file = $request->file('images');
            $profile = $file->store('/images/team', 'public');
        }else{
            $profile=  $data->image ?? '';
        }

        $array = [
            'title' => $request->title ,
            'contant' => $request->content ,
            'image' => $profile ,
            'status' => $request->status ?? '1',
            'type' => $request->type,
        ];

        if($data != ''){
        $data->Update($array);
        }else
        {
            About::create($array);
        }
        return redirect()->route('admin.about.council')->with('status', 'Council update successfully');

    }

    public function History(Request $request){
        $this->authorize('about_us');
        $About = About::where('type', 'History')->first();
        $data['tab'] = $request->filled('tab') ? $request->tab : 'About';
        $data['About'] = $About;
        return view('admin.about.history', $data);
    }

    public function History_update(Request $request ){
        $this->authorize('about_us_edit');
        $this->validate($request,[
            'title'  => 'required',
            'content'  => 'required',
            // 'status' => 'required',
            'images'  => 'nullable|mimes:jpeg,jpg,png',
        ]);


        // $data = About::find($id);
        $data = About::where('type' ,$request->type)->first();

        if ($request->hasFile('images')) {
            $file = $request->file('images');
            $profile = $file->store('/images/team', 'public');
        }else{
            $profile=  $data->image ?? '';
        }
        $array = [
            'title' => $request->title ,
            'contant' => $request->content ,
            'image' => $profile ,
            'status' => $request->status ?? '1',
            'type' => $request->type
        ];
        if($data !=  ''){
        $data->Update($array);
        }else{
            About::create($array);
        }

        return redirect()->route('admin.about.history')->with('status', 'History update successfully');
    }

 



    // public function Mission (){
    //     $data= About::where('type', 'Mission')->first();
    //     return view('admin.about.mission', compact('data'));
    // }

    public function Mission_update(Request $request){
     
        $this->validate($request,[
            'title'  => 'required',
            'content'  => 'required',
            // 'status' => 'required',
            'images'  => 'nullable|mimes:jpeg,jpg,png',
        ]);
        $data = About::where('type' ,$request->type)->first();
        if ($request->hasFile('images')) {
            $file = $request->file('images');
            $profile = $file->store('/images/team', 'public');
        }else{
            $profile=  $data->image ?? '';
        }
        $array = [
            'title' => $request->title ,
            'contant' => $request->content ,
            'image' => $profile ?? '' ,
            'status' => $request->status ?? '1',
            'type'  => $request->type,
        ];
        if($data != ''){ 
        $data->Update($array);
        }else{
            About::create($array);
        }
        return redirect()->route('admin.about.introduction',['tab' => $request->type] )->with('status', 'Mission update successfully');
    }

    public function Testimonials (){
        $data= About::where('type', 'Mission')->first();
        return view('admin.about.mission', compact('data'));
    }


}
