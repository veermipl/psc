<?php

namespace App\Http\Controllers\Admin;

use App\Models\Testimonials;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class TestimonialController extends Controller
{
    public function Index(){
        $this->authorize('about_us');

        $data = Testimonials::orderby('id', 'desc')->get();
        return view('admin.testimonial.list', compact('data'));
    }

    public function create(){
        $this->authorize('about_us_create');
        return view('admin.testimonial.create');
    }
    public function Store(Request $request){
        $this->authorize('about_us_create');
        // dd($request->all());

        $this->validate($request,[
            'title'     => 'required',
            'content'   => 'required',
            'status'    => 'required',
            'images'    => 'nullable|mimes:jpeg,jpg,png'
        ]);
        if ($request->hasFile('images')) {
            $file = $request->file('images');
            $profile = $file->store('/images/testimonial', 'public');
        }
        $array = [
            'title' => $request->title ,
            'contant' => $request->content ,
            'image' => $profile ?? '' ,
            'status' => $request->status,
            'type' => 'testimonials',
        ];
        Testimonials::create($array);
        return redirect()->route('admin.about.introduction',['tab' => $request->type])->with('status', 'Strategic Priority Areas Create successfully');

    }

    public function status(Request $request) {
        $this->authorize('about_us_status_edit');
        $user = Testimonials::find($request->lid);
        $status = $request->lstatus == 1 ? '0' : '1';
        DB::transaction(function () use ($user, $status) {
            $user->update([
                'status' => $status
            ]);
        });
        $data['error'] = false;
        $data['msg'] = 'Strategic Priority Areas status updated';
        return response()->json($data, 200);
    }

    public function destroy(Request $request, ){
        $this->authorize('about_us_delete');

        $user = Testimonials::find($request->lid);
        $user->delete();
        $data['error'] = false; 
        $data['msg'] = 'Strategic Priority Areas Deleted';
        return response()->json($data, 200);  
    }
    
    public function edit($id) {
        $this->authorize('about_us_edit');

    $data = Testimonials::find($id);
        return view('admin.testimonial.edit', compact('data'));
    }

    public function Update(Request $request, $id){
        $this->authorize('about_us_edit');
        $this->validate($request,[
            'title'     => 'required',
            'content'   => 'required',
            'status'    => 'required',
            'images'    => 'nullable|mimes:jpeg,jpg,png'
        ]);
        $test = Testimonials::find($id);
        if ($request->hasFile('images')) {
            $file = $request->file('images');
            $profile = $file->store('/images/testimonial', 'public');
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
        return redirect()->route('admin.about.introduction',['tab' => $request->type])->with('status', 'Strategic Priority Areas update successfully');

    }


}