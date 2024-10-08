<?php

namespace App\Http\Controllers\admin;

use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('permission_list');

        $filterValues = [
            'name' => $request->name ?? null,
            'status' => $request->status ?? null,
        ];

        $permissionModule = Permission::select('module')->groupBy('module')->get()->pluck('module')->toArray();
        $permissionList = Permission::get();

        $data['permissionModule'] = $permissionModule;
        $data['permissionList'] = $permissionList;
        $data['filterValues'] = $filterValues;
        $data['export_id'] = $permissionList->pluck('id')->toArray();

        return view('admin.authorization.permission.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
    }
}
