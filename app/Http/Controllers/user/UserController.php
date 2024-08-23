<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\user\UpdateProfileRequest;
use App\Http\Requests\user\UpdateProfileStatusRequest;

class UserController extends Controller
{
    public function profile()
    {
        $this->authorize('profile_view');

        $userRole = Auth::user()->role->pluck('name')->toArray();

        $data['user'] = Auth::user();
        $data['userRole'] = $userRole;

        if(in_array('Admin', $userRole)){
            return view('profile', $data);
        }

        return view('member_profile', $data);

    }

    public function profileUpdate(UpdateProfileRequest $request)
    {
        $this->authorize('profile_update');

        $validated = $request->validated();
        dd($validated);

        DB::transaction(function () {
            
        });

        return redirect()->route('admin.user.index')->with('success', 'Profile Updated');
    }

    public function profileStatus(UpdateProfileStatusRequest $request)
    {
        $this->authorize('profile_active_deactive');

        $validated = $request->validated();
        dd($validated);

        DB::transaction(function () {
            
        });

        return redirect()->route('admin.user.index')->with('success', 'Profile Updated');
    }
}
