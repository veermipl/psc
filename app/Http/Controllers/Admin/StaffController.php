<?php

namespace App\Http\Controllers\Admin;

use App\Models\Staff;
use App\Traits\ImageTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class StaffController extends Controller
{
    use  ImageTraits;
    public function create(){
        $this->authorize('about_us');
        return view('admin.staff.create');
    }
    public function store(Request $request){
        $this->authorize('about_us_create');
        // dd($request->all());
        $this->validate($request,[
            'name'  => 'required',
            'office'  => 'required',
            'profile'  => 'required',
            'profile'  => 'required|mimes:jpeg,jpg,png',
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
            'office' => $request->office ?? '',
            'facebook' => $request->facebook ?? '',
            'twitter' => $request->twitter ?? '',
            'instra' => $request->instagram ?? '',
            'dribbble' => $request->dribbble ??'',
            'status' => $request->status,
            'image' => $profile ?? '',
        ];
        Staff::create($create);
        return redirect()->route('admin.staff.list')->withSuccess('Staff create successfully!');
    }

    public function list(){
        $this->authorize('about_us_view');
        $data = Staff::where('deleted_at', '0')->orderby('id', 'desc')->get();
        return view('admin.staff.index', compact('data'));

    }

    public function status(Request $request) {
        $this->authorize('about_us_status_edit');
        $user = Staff::find($request->uid);
        $status = $request->lstatus == 1 ? '0' : '1';

        DB::transaction(function () use ($user, $status) {
            $user->update([
                'status' => $status
            ]);
        });
        $data['error'] = false;
        $data['msg'] = 'Staff status updated';

        return response()->json($data, 200);
    }

    public function destroy(Request $request, $id){
        $this->authorize('about_us_delete');
        
        $user = Staff::find($id);
        $user->delete();
        $data['error'] = false; 
        $data['msg'] = 'User Deleted';

        return response()->json($data, 200);  
    }

    public function edit($id) {
        $this->authorize('about_us_edit');
        $data = Staff::find($id);
        return view('admin.staff.edit', compact('data'));
    }

    public function Update (Request $request, $id){
        $this->authorize('about_us_edit');
        // dd($request->all());
        $this->validate($request,[
            'name'  => 'required',
            'office'  => 'required',
            // 'profile'  => 'required',
            'status' => 'required',
            'profile'  => 'nullable|mimes:jpeg,jpg,png',
        ]);
        $staff = Staff::find($id);
        if ($request->hasFile('profile')) {
            $file = $request->file('profile');
            $profile = $file->store('/images/team', 'public');
        }else{
            $profile=  $staff->image;
        }
        $array = [
            'name' => $request->name ,
            // 'email' => $request->status ?? '',
            'office' => $request->office ,
            'facebook' => $request->facebook ,
            'twitter' => $request->twitter ,
            'instra' => $request->instagram ,
            'dribbble' => $request->dribbble ,
            'status' => $request->status,
            'image' => $profile,
        ];
        $staff->Update($array);
        return redirect()->route('admin.staff.list')->with('status', 'Staff update successfully');
    }

}
