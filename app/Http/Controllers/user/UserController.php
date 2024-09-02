<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\UserDetails;
use App\Traits\ImageTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\user\DeleteProfileRequest;
use App\Http\Requests\user\UpdateProfileRequest;
use App\Http\Requests\user\UpdateProfileStatusRequest;

class UserController extends Controller
{
    use ImageTraits;

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

        if (in_array('Admin', $userRole)) {
            return view('user.profile_edit', $data);
        }

        return view('user.member_profile_edit', $data);
    }

    public function profileUpdate(UpdateProfileRequest $request)
    {
        $this->authorize('profile_update');

        $validated = $request->validated();

        $profileImage = $validated['old_profile_image'] ?? null;
        if ($request->hasFile('profile_image')) {
            $file = $request->file('profile_image');

            $profileImage = $file->store('user_profile', 'public');

            $this->deleteFromStorage('public', $validated['old_profile_image'], $isArray = false);
        }
        $validated['profile_image'] = $profileImage;

        $bgImage = $validated['old_background_image'] ?? null;
        $validated['background_image'] = $bgImage;

        DB::transaction(function () use ($validated) {
            User::where('id', $validated['user_id'])->update([
                'name' => $validated['name'],
                'mobile_number' => $validated['mobile_number'],
            ]);

            UserDetails::updateOrCreate(
                [
                    'user_id' => $validated['user_id']
                ],
                [
                    'profile_image' => $validated['profile_image'],
                    'background_image' => $validated['background_image'],
                    'date_of_birth' => $validated['date_of_birth'],
                    'gender' => $validated['gender'],
                    'connect_url' => $validated['connect_url'],
                    'connect_fb' => $validated['connect_fb'],
                    'connect_twitter' => $validated['connect_twitter'],
                    'connect_linkedin' => $validated['connect_linkedin'],
                    'address' => $validated['address'],
                    'location' => $validated['location'],
                    'about_me' => $validated['about_me'],
                ]
            );
        });

        return redirect()->route('profile')->with('success', 'Profile Updated');
    }

    public function profileStatus(UpdateProfileStatusRequest $request)
    {
        $this->authorize('profile_active_deactive');

        $validated = $request->validated();

        DB::transaction(function () use ($validated) {
            User::where('id', $validated['uid'])->update([
                'status' => '0'
            ]);
        });

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $data['error'] = false;
        $data['msg'] = 'Your account has been de-activated!';
        $data['redirect'] = route('login');

        Session::flash('success', $data['msg']);

        return response()->json($data, 200);
    }

    public function profileDelete(DeleteProfileRequest $request)
    {
        $this->authorize('profile_delete');

        $validated = $request->validated();

        DB::transaction(function () use ($validated) {
            User::where('id', $validated['uid'])->delete();
        });

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $data['error'] = false;
        $data['msg'] = 'Your account has been deleted!';
        $data['redirect'] = route('login');

        Session::flash('success', $data['msg']);

        return response()->json($data, 200);
    }
}
