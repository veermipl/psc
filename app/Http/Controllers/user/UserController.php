<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\user\DeleteProfileRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\user\UpdateProfileRequest;
use App\Http\Requests\user\UpdateProfileStatusRequest;
use App\Models\UserDetails;

class UserController extends Controller
{
    public function profile()
    {
        $this->authorize('profile_view');

        $userRole = Auth::user()->role->pluck('name')->toArray();
        $userDetails = UserDetails::where('user_id', Auth::user()->id)->first();

        $data['user'] = Auth::user();
        $data['UserDetails'] = $userDetails;
        $data['userRole'] = $userRole;

        if (in_array('Admin', $userRole)) {
            return view('user.profile', $data);
        }

        return view('user.member_profile', $data);
    }

    public function profileEdit()
    {
        $this->authorize('profile_update');

        $userRole = Auth::user()->role->pluck('name')->toArray();
        $userDetails = UserDetails::where('user_id', Auth::user()->id)->first();

        $data['user'] = Auth::user();
        $data['UserDetails'] = $userDetails;
        $data['userRole'] = $userRole;

        return view('user.profile_edit', $data);
    }

    public function profileUpdate(UpdateProfileRequest $request)
    {
        $this->authorize('profile_update');

        $validated = $request->validated();

        $profileImage = null;
        if ($request->hasFile('profile_image')) {
            $file = $request->file('profile_image');

            $profileImage = $file->store('user_profile', 'public');
        }
        $validated['profile_image'] = $profileImage;

        DB::transaction(function () use ($validated) {
            UserDetails::updateOrCreate(
                [
                    'user_id' => $validated['user_id']
                ],
                [
                    'profile_image' => $validated['profile_image'],
                    'background_image' => $validated['background_image'],
                    'mobile_number' => $validated['mobile_number'],
                    'connect_url' => $validated['connect_url'],
                    'connect_fb' => $validated['connect_fb'],
                    'connect_twitter' => $validated['connect_twitter'],
                    'connect_linkedin' => $validated['connect_linkedin'],
                    'location' => $validated['location'],
                    'address' => $validated['address'],
                    'about_me' => $validated['about_me'],
                    'gender' => $validated['gender'],
                ]
            );
        });

        return redirect()->route('profile')->with('success', 'Profile Updated');
    }

    public function profileStatus(UpdateProfileStatusRequest $request)
    {
        $this->authorize('profile_active_deactive');

        $validated = $request->validated();
        dd($validated);

        DB::transaction(function () {});

        $data['error'] = false;
        $data['msg'] = 'Account de-activated';

        return response()->json($data, 200);
    }

    public function profileDelete(DeleteProfileRequest $request)
    {
        $this->authorize('profile_delete');

        $validated = $request->validated();
        dd($validated);

        DB::transaction(function () {});

        $data['error'] = false;
        $data['msg'] = 'Account Deleted';

        return response()->json($data, 200);
    }
}
