<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\MembershipType;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;

class AdminController extends Controller
{
    public function login()
    {
        return view('admin.login');
    }

    public function dashboard(Request $request)
    {
        $this->authorize('admin_dashboard');
        $mytime = Carbon::now();

        $membershipType = MembershipType::orderBy('id', 'desc')->where('status', '1')->get() ?? [];

        $totalMembers = User::orderBy('id', 'desc')->whereHas('role', function (Builder $x) {
            $x->where('role_id', 2);
        })->get() ?? [];
        $totalActiveMembers = User::orderBy('id', 'desc')->where('status', '1')->whereHas('role', function (Builder $x) {
            $x->where('role_id', 2);
        })->get() ?? [];
        $totalInActiveMembers = User::orderBy('id', 'desc')->where('status', '0')->whereHas('role', function (Builder $x) {
            $x->where('role_id', 2);
        })->get() ?? [];

        $TodaytotalMembers = User::orderBy('id', 'desc')->whereHas('role', function (Builder $x) {
            $x->where('role_id', 2);
        }) ->whereDate('created_at', $mytime->toDateString())->get() ?? [];

     $todattotalActiveMembers = User::orderBy('id', 'desc')->where('status', '1')->whereHas('role', function (Builder $x) {
            $x->where('role_id', 2);
        }) ->whereDate('created_at', $mytime->toDateString())->get() ?? [];

    $todaytotalInActiveMembers = User::orderBy('id', 'desc')->where('status', '0')->whereHas('role', function (Builder $x) {
            $x->where('role_id', 2);
        }) ->whereDate('created_at', $mytime->toDateString())->get() ?? [];


        $data['membershipType'] = $membershipType;
        $data['totalMembers'] = $totalMembers;
        $data['totalActiveMembers'] = $totalActiveMembers;
        $data['totalInActiveMembers'] = $totalInActiveMembers;
        $data['TodaytotalMembers'] = $TodaytotalMembers;
        $data['todattotalActiveMembers'] = $todattotalActiveMembers;
        $data['todaytotalInActiveMembers'] = $todaytotalInActiveMembers;


        return view('admin.dashboard', $data);
    }
}
