<?php

namespace App\Http\Controllers\Admin;

use App\Models\Staff;
use App\Traits\ImageTraits;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StaffController extends Controller
{
    use  ImageTraits;
    public function create(){

        return view('admin.staff.create');
    }
    public function store(Request $request){

        // dd($request->all());
        $this->validate($request,[
            'name'  => 'required',
            'office'  => 'required',
            'profile'  => 'required',
            'status' => 'required'
        ]);


        // $profile = null;
        if ($request->hasFile('profile')) {
            $file = $request->file('profile');
            $profile = $file->store('/images/team', 'public');
        }

        $create = [
            'name' => $request->name ?? '',
            // 'email' => $request->status ?? '',
            'office' => $request->name ?? '',
            'facebook' => $request->facebook ?? '',
            'twitter' => $request->twitter ?? '',
            'instra' => $request->instagram ?? '',
            'dribbble' => $request->dribbble ??'',
            'status' => $request->status,
            'image' => $profile,
        ];
        Staff::create($create);
        return redirect()->route('admin.satff.list')->withSuccess('Staff create successfully!');
    }

    public function list(){
        $data = Staff::where('deleted_at', '0')->orderby('id', 'desc')->get();

        // dd($data);   
        return view('admin.staff.index', compact('data'));

    }
}
