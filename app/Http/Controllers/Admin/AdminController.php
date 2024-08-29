<?php

namespace App\Http\Controllers\Admin;

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

        $data['membershipType'] = $membershipType;
        $data['totalMembers'] = $totalMembers;
        $data['totalActiveMembers'] = $totalActiveMembers;
        $data['totalInActiveMembers'] = $totalInActiveMembers;

        return view('admin.dashboard', $data);
    }
}
