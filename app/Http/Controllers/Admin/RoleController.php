<?php

namespace App\Http\Controllers\admin;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Requests\admin\authorization\role\CreateRoleRequest;
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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('role_create');

        $permissionModule = Permission::select('module')->groupBy('module')->get();
        dd($permissionModule);
        $permissionList = Permission::get();

        $data['permissionModule'] = $permissionModule;
        $data['permissionList'] = $permissionList;

        return view('admin.authorization.role.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRoleRequest $request)
    {
        $this->authorize('role_create');

        $validated = $request->validated();

        DB::transaction(function () use ($validated) {
            Role::create([
                'name' => $validated['name'],
            ]);
        });

        return redirect()->route('admin.authorization.role.index')->with('success', 'Role created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        $this->authorize('role_create');

        $permissionList = Permission::get();

        $data['role'] = $role;
        $data['permissions'] = $permissionList;

        return view('admin.authorization.role.view', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $this->authorize('role_edit');
        
        $permissionList = Permission::get();

        $data['role'] = $role;
        $data['permissions'] = $permissionList;

        return view('admin.authorization.role.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {
        $this->authorize('role_edit');

        $validated = $request->validated();

        DB::transaction(function () use ($role, $validated) {
            $role->update([
                'name' => $validated['name'],
                'status' => $validated['status'],
            ]);
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
}
