<?php

namespace App\Http\Controllers\admin;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Requests\admin\authorization\role\CreateRoleRequest;
use App\Http\Requests\admin\authorization\role\ExportRoleRequest;
use App\Http\Requests\admin\authorization\role\UpdateRoleRequest;
use App\Http\Requests\admin\authorization\role\UpdateRoleStatusRequest;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('role_list');

        $filterValues = [
            'name' => $request->name ?? null,
            'type' => $request->type ?? null,
        ];
        $list = Role::orderBy('name', 'asc')
            ->where(function (Builder $query) use ($filterValues, $request) {
                $query->when($request->filled('name'), function (Builder $q) use ($filterValues) {
                    $q->where('name', 'like', '%' . $filterValues['name'] . '%');
                })
                    ->when($request->filled('type'), function (Builder $q) use ($filterValues) {
                        $q->where('type', $filterValues['type']);
                    });
            })
            ->get();

        $data['filterValues'] = $filterValues;
        $data['list'] = $list;
        $data['export_id'] = $list->pluck('id')->toArray();

        return view('admin.authorization.role.index', $data);
    }

    public function export(ExportRoleRequest $request)
    {
        $this->authorize('role_export');

        $validated = $request->validated();

        $fileName = 'role.csv';
        $noData = 'NA';
        $dataarray = array();
        $role_ids = explode(',', $validated['export_id']);

        $roles = Role::orderBy('name', 'asc')->whereIn('id', $role_ids)->get();

        foreach ($roles as $roleKey => $role) {
            $dataarray[] = [
                'id' => $role->id,
                'name' => $role->name ?? $noData,
                'type' => $role->type ?? $noData,
            ];
        }

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );
        $columns = array('ID', 'Name', 'Type');
        $callback = function () use ($dataarray, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($dataarray as $task) {
                $row['ID'] = $task['id'];
                $row['Name'] = $task['name'];
                $row['Type'] = $task['type'];

                fputcsv($file, array($row['ID'], $row['Name'], $row['Type']));
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
        $this->authorize('role_create');

        $permissionModule = Permission::select('module')->groupBy('module')->get()->pluck('module')->toArray();
        $permissionList = Permission::get();
        $defaultPermissionList = ['member_dashboard', 'profile_view', 'profile_update',''];

        $data['permissionModule'] = $permissionModule;
        $data['permissionList'] = $permissionList;
        $data['defaultPermissionList'] = $defaultPermissionList;

        return view('admin.authorization.role.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRoleRequest $request)
    {
        $this->authorize('role_create');

        $validated = $request->validated();

        $permissionsToSync = array();
        foreach ($validated['permissions'] as $key => $value) {
            $dbPermissionId = Permission::where('name_key', $key)->pluck('id')->first();
            array_push($permissionsToSync, $dbPermissionId);
        }

        DB::transaction(function () use ($validated, $permissionsToSync) {
            $dbRole = Role::create([
                'name' => $validated['name'],
            ]);

            $dbRole->permissions()->sync($permissionsToSync);
        });

        return redirect()->route('admin.authorization.role.index')->with('success', 'Role created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        $this->authorize('role_create');

        $role->load('permissions');
        
        $permissions = $role->permissions;
        $permissionModule = $permissions->unique('module')->pluck('module')->toArray();
        sort($permissionModule);

        $data['permissionModule'] = $permissionModule;
        $data['permissionList'] = $permissions;
        $data['role'] = $role;

        return view('admin.authorization.role.view', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $this->authorize('role_edit');
        
        $role->load('permissions');
        
        $permissionModule = Permission::select('module')->groupBy('module')->get()->pluck('module')->toArray();
        $permissionList = Permission::get();
        $rolePermissionList = $role->permissions->pluck('name_key')->toArray();

        $data['permissionModule'] = $permissionModule;
        $data['permissionList'] = $permissionList;
        $data['rolePermissionList'] = $rolePermissionList;
        $data['role'] = $role;

        return view('admin.authorization.role.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {
        $this->authorize('role_edit');

        $validated = $request->validated();

        $permissionsToSync = array();
        foreach ($validated['permissions'] as $key => $value) {
            $dbPermissionId = Permission::where('name_key', $key)->pluck('id')->first();
            array_push($permissionsToSync, $dbPermissionId);
        }

        DB::transaction(function () use ($role, $validated, $permissionsToSync) {
            $role->update([
                'name' => $validated['name'],
            ]);

            $role->permissions()->sync($permissionsToSync);
        });

        return redirect()->route('admin.authorization.role.index')->with('success', 'Role updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $this->authorize('role_delete');

        DB::transaction(function () use ($role) {
            $role->delete();
        });

        $data['error'] = false;
        $data['msg'] = 'Role Deleted';

        return response()->json($data, 200);
    }

    // public function getUserRolePermissions()
    // {
    //     $this->authorize('user_role_permission_view');

    //     $validated = request()->validate([
    //         'userId' => ['required', 'integer', 'exists:users,id']
    //     ]);

    //     $user = User::find($validated['userId']);
    //     $user->load(['role.permissions']); //load permission relating to selected role of user

    //     $userPermissions = $user->permissions;
    //     $rolePermissions = $user->role->pluck('permissions')->collapse();


    //     $data['user'] = $user;
    //     $data['role'] = $user->role->first();

    //     $data['permissionList'] = $rolePermissions->unique('controller')->pluck('controller');
    //     $data['permissionNameKeyList'] = $rolePermissions->unique('name_key')->pluck('name_key')->toArray();
        
    //     $data['userPermissions'] = $userPermissions;
    //     $data['status'] = true;

    //     return response()->json($data);
    // }

    // public function updateUserRolePermissions(UpdateUserRolePermissionRequest $request)
    // {
    //     $this->authorize('user_role_permission_update');

    //     $validated = $request->validated();

    //     $permissionsToSync = array();
    //     foreach ($validated['permissions'] as $key => $value) {
    //         $dbPermissionId = Permission::where('name_key', $key)->pluck('id')->first();
    //         array_push($permissionsToSync, $dbPermissionId);
    //     }

    //     $user = User::find($validated['user_id']);
    //     $role = Role::where('id', $validated['role'])->pluck('id')->toArray();

    //     DB::transaction(function () use ($role, $user, $permissionsToSync) {
    //         $user->role()->sync($role);

    //         $user->permissions()->sync($permissionsToSync);
    //     });
    // }
}
