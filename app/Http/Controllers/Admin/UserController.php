<?php

namespace App\Http\Controllers\admin;

use App\Models\Role;
use App\Models\User;
use App\Traits\UserTraits;
use Illuminate\Http\Request;
use App\Models\MembershipType;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Requests\admin\user\ExporUserRequest;
use App\Http\Requests\admin\user\StoreUserRequest;
use App\Http\Requests\admin\user\UpdateUserRequest;
use App\Http\Requests\admin\user\UpdateUserStatusRequest;

class UserController extends Controller
{
    use UserTraits;
    
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('user_list');

        $filterValues = [
            'name' => $request->name ?? null,
            'email' => $request->email ?? null,
            'membership_type' => $request->membership_type ?? null,
            'role' => $request->role ?? null,
            'status' => $request->status ?? null,
        ];
        $userList = User::with(['membership'])->orderBy('id', 'desc')
            ->where(function (Builder $query) use ($filterValues, $request) {
                $query->when($request->filled('name'), function (Builder $q) use ($filterValues) {
                    $q->where('name', 'like', '%' . $filterValues['name'] . '%');
                })
                ->when($request->filled('email'), function (Builder $q) use ($filterValues) {
                    $q->where('email', $filterValues['email']);
                })
                ->when($request->filled('membership_type'), function (Builder $q) use ($filterValues) {
                    $q->where('membership_type', $filterValues['membership_type']);
                })
                ->when($request->filled('role'), function (Builder $q) use ($filterValues) {
                    $q->whereHas('role', function(Builder $x) use ($filterValues){
                        $x->where('role_id', $filterValues['role']);
                    });
                })
                ->when($request->filled('status'), function (Builder $q) use ($filterValues) {
                    $q->where('status', $filterValues['status']);
                })
                ;
            })
            ->get();
        $roleList = Role::orderBy('name', 'asc')->get();
        $membershipList = MembershipType::orderBy('name', 'asc')->get();

        $data['filterValues'] = $filterValues;
        $data['userList'] = $userList;
        $data['export_id'] = $userList->pluck('id')->toArray();
        $data['roleList'] = $roleList;
        $data['membershipList'] = $membershipList;

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

        $data['membershipList'] = MembershipType::orderBy('name', 'asc')->get();
        $data['roleList'] = Role::orderBy('name', 'asc')->get();

        return view('admin.user.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $this->authorize('user_create');

        $validated = $request->validated();

        DB::transaction(function () use($validated) {
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'mobile_number' => $validated['contact'],
                'membership_type' => null,
                'form_pdf' => null,
                'profile' => null,
                'status' => $validated['status'],
                'password' => Hash::make($validated['password']),
            ]);

            $user->role()->sync(Role::where('id', $validated['status'])->pluck('id')->toArray());
            $this->InitialUserRolePermission($user);
        });

        return redirect()->route('admin.user.index')->with('status', 'User created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $this->authorize('user_view');

        $data['user'] = $user;
        $data['membershipList'] = MembershipType::orderBy('name', 'asc')->get();

        return view('admin.user.view', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $this->authorize('user_edit');

        $data['user'] = $user;
        $data['membershipList'] = MembershipType::orderBy('name', 'asc')->get();

        return view('admin.user.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $this->authorize('user_edit');

        $validated = $request->validated();
        
        $formPdfPath = null;
        if ($request->hasFile('form_pdf')) {
            $file = $request->file('form_pdf');

            $formPdfPath = $file->store('uploaded_forms', 'public');
        }
        $validated['form_pdf'] = $formPdfPath;

        if($request->filled('password')){
            $validated['password'] = Hash::make($validated['password']);
        }else{
            $validated['password'] = $user->password;
        }

        
        DB::transaction(function () use ($user, $validated) {
            $user->update([
                'name' => $validated['name'],
                'mobile_number' => $validated['contact'],
                'membership_type' => $validated['membership_type'],
                'form_pdf' => $validated['form_pdf'],
                'password' => $validated['password'],
                'status' => $validated['status'],
            ]);
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
