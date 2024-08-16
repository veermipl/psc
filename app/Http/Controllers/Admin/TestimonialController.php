<?php

namespace App\Http\Controllers\Admin;

use App\Models\Testimonials;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class TestimonialController extends Controller
{
    public function Index(){
        $data = Testimonials::orderby('id', 'desc')->get();
        return view('admin.testimonial.list', compact('data'));
    }

    public function create(){
        return view('admin.testimonial.create');
    }
    public function Store(Request $request){
        // dd($request->all());

        $this->validate($request,[
            'title'     => 'required',
            'content'   => 'required',
            'status'    => 'required',
            'images'    => 'required|mimes:jpeg,jpg,png'
        ]);
        if ($request->hasFile('images')) {
            $file = $request->file('images');
            $profile = $file->store('/images/testimonial', 'public');
        }
        $array = [
            'title' => $request->title ,
            'contant' => $request->content ,
            'image' => $profile ,
            'status' => $request->status,
        ];
        Testimonials::create($array);
        return redirect()->route('admin.testimonial.list')->with('status', 'Testimonial Create successfully');

    }

    public function status(Request $request) {
        $user = Testimonials::find($request->uid);
        $status = $request->ustatus == 1 ? '0' : '1';
        DB::transaction(function () use ($user, $status) {
            $user->update([
                'status' => $status
            ]);
        });
        $data['error'] = false;
        $data['msg'] = 'Testimonials status updated';
        return response()->json($data, 200);
    }

    public function destroy(Request $request, $id){
        $user = Testimonials::find($id);
        $user->delete();
        $data['error'] = false; 
        $data['msg'] = 'Testimonials Deleted';
        return response()->json($data, 200);  
    }
    
    public function edit($id) {
    $data = Testimonials::find($id);
        return view('admin.testimonial.edit', compact('data'));
    }

    public function Update(Request $request, $id){
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
        return redirect()->route('admin.testimonial.list')->with('status', 'Testimonial update successfully');

    }


}