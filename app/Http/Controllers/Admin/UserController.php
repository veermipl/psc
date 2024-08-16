<?php

namespace App\Http\Controllers\admin;

use App\Models\Role;
use App\Models\User;
use App\Traits\UserTraits;
use Illuminate\Http\Request;
use App\Traits\SettingTraits;
use App\Models\MembershipType;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Requests\admin\user\ExporUserRequest;
use App\Http\Requests\admin\user\StoreUserRequest;
use App\Http\Requests\admin\user\UpdateUserRequest;
use App\Mail\admin\user\SendUserWelcomeRegistrationMail;
use App\Http\Requests\admin\user\UpdateUserStatusRequest;

class UserController extends Controller
{
    use UserTraits, SettingTraits;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('user_list');

        $filterValues = [
            'name' => $request->name ?? null,
            'role' => $request->role ?? null,
            'status' => $request->status ?? null,
        ];
        $userList = User::orderBy('id', 'desc')
            ->whereHas('role', function (Builder $x) {
                $x->whereNotIn('role_id', [2]);
            })
            ->where(function (Builder $query) use ($filterValues, $request) {
                $query->when($request->filled('name'), function (Builder $q) use ($filterValues) {
                    $q->where('name', 'like', '%' . $filterValues['name'] . '%');
                })
                    ->when($request->filled('role'), function (Builder $q) use ($filterValues) {
                        $q->whereHas('role', function (Builder $x) use ($filterValues) {
                            $x->where('role_id', $filterValues['role']);
                        });
                    })
                    ->when($request->filled('status'), function (Builder $q) use ($filterValues) {
                        $q->where('status', $filterValues['status']);
                    });
            })
            ->get();
        $roleList = Role::orderBy('name', 'asc')->whereNotIn('id', [2])->get();

        $data['filterValues'] = $filterValues;
        $data['userList'] = $userList;
        $data['export_id'] = $userList->pluck('id')->toArray();
        $data['roleList'] = $roleList;

        return view('admin.user.index', $data);
    }

    public function export(ExporUserRequest $request)
    {
        $this->authorize('user_export');

        $validated = $request->validated();

        $fileName = 'user_data.csv';
        $noData = 'NA';
        $dataarray = array();
        $user_ids = explode(',', $validated['export_id']);

        $users = User::orderBy('name', 'asc')->where('id', $user_ids)->get();

        foreach ($users as $userKey => $user) {
            $userRoles = $user->role ? $user->role->pluck('name')->toArray() : [];
            $membershipData = $user->membership_type;
            $statusData = $user->status;

            $dataarray[] = [
                'id' => $user->id,
                'name' => $user->name ?? $noData,
                'email' => $user->email ?? $noData,
                'mobile' => $user->mobile_number ?? $noData,
                'membership_type' => $membershipData ?? $noData,
                'role' => implode(', ', $userRoles),
                'status' => $statusData,
            ];
        }

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );
        $columns = array('ID', 'Name', 'Email', 'Mobile', 'Membership', 'Role', 'Status');
        $callback = function () use ($dataarray, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($dataarray as $task) {
                $row['ID'] = $task['id'];
                $row['Name'] = $task['name'];
                $row['Email'] = $task['email'];
                $row['Mobile'] = $task['mobile'];
                $row['Membership'] = $task['membership_type'];
                $row['Role'] = $task['role'];
                $row['Status'] = $task['status'];

                fputcsv($file, array($row['ID'], $row['Name'], $row['Email'], $row['Mobile'], $row['Membership'], $row['Role'], $row['Status']));
            }

            fclose($file);
        };
        return response()->stream($callback, 200, $headers);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('user_create');

        $data['roleList'] = Role::orderBy('name', 'asc')->whereNotIn('id', [2])->get();

        return view('admin.user.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $this->authorize('user_create');

        $validated = $request->validated();

        DB::transaction(function () use ($validated) {
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'status' => $validated['status'],
            ]);

            $user->role()->sync(Role::where('id', $validated['role'])->pluck('id')->toArray());
            $this->InitialUserRolePermission($user);

            $userData = $validated;
            $userData['password'] = $validated['password'];
            $userData['app_name'] = $this->getSettings('app_name') ?? config('app.name');
            $userData['support_mail'] = $this->getSettings('email') ?? 'psc@support.com';

            Mail::to($userData['email'])->queue((new SendUserWelcomeRegistrationMail($userData))->afterCommit());
        });

        return redirect()->route('admin.user.index')->with('success', 'User created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $this->authorize('user_view');

        $data['user'] = $user;

        return view('admin.user.view', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $this->authorize('user_edit');

        $userRoles = $user->role ? $user->role->pluck('id')->toArray() : [];

        $data['user'] = $user;
        $data['userRoles'] = $userRoles;
        $data['roleList'] = Role::orderBy('name', 'asc')->whereNotIn('id', [2])->get();

        return view('admin.user.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $this->authorize('user_edit');

        $validated = $request->validated();

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            $validated['password'] = $user->password;
        }

        DB::transaction(function () use ($user, $validated) {
            $user->update([
                'name' => $validated['name'],
                'status' => $validated['status'],
                'password' => $validated['password'],
            ]);

            //update assigned role
        });

        return redirect()->route('admin.user.index')->with('success', 'User Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $this->authorize('user_delete');

        DB::transaction(function () use ($user) {
            $user->delete();
        });

        $data['error'] = false;
        $data['msg'] = 'User Deleted';

        return response()->json($data, 200);
    }

    public function statusToggle(UpdateUserStatusRequest $request)
    {
        $this->authorize('user_status_edit');
        $validated = $request->validated();

        $user = User::find($validated['uid']);
        $status = $validated['ustatus'] == 1 ? '0' : '1';

        DB::transaction(function () use ($user, $status) {
            $user->update([
                'status' => $status
            ]);
        });

        $data['error'] = false;
        $data['msg'] = 'User status updated';

        return response()->json($data, 200);
    }
}
