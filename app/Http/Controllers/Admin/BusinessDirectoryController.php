<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\membership\business_directory\StoreBusinessDirectoryRequest;
use App\Http\Requests\admin\membership\business_directory\UpdateBusinessDirectoryRequest;
use App\Http\Requests\admin\membership\business_directory\UpdateBusinessDirectoryStatusRequest;
use App\Models\BusinessDirectory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;

class BusinessDirectoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('membership');

        $filterValues = [
            'name' => $request->name ?? null,
            'status' => $request->status ?? null,
        ];
        $list = BusinessDirectory::orderBy('id', 'desc')
            ->where(function (Builder $query) use ($filterValues, $request) {
                $query->when($request->filled('name'), function (Builder $q) use ($filterValues) {
                    $q->where('name', 'like', '%' . $filterValues['name'] . '%');
                })
                    ->when($request->filled('status'), function (Builder $q) use ($filterValues) {
                        $q->where('status', $filterValues['status']);
                    });
            })
            ->get();

        $data['filterValues'] = $filterValues;
        $data['list'] = $list;
        $data['export_id'] = $list->pluck('id')->toArray();

        return view('admin.membership.business_directory.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('membership_create');

        return view('admin.membership.business_directory.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBusinessDirectoryRequest $request)
    {
        $this->authorize('membership_create');

        $validated = $request->validated();

        DB::transaction(function () use ($validated) {
            BusinessDirectory::create([
                'name' => $validated['name'],
                'sub_name' => $validated['sub_name'],
                'status' => $validated['status'],
            ]);
        });

        return redirect()->route('admin.membership.business-directory.index')->with('success', 'Business Directory created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(BusinessDirectory $business_directory)
    {
        $this->authorize('membership_view');

        $data['business_directory'] = $business_directory;

        return view('admin.membership.business_directory.view', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BusinessDirectory $business_directory)
    {
        $this->authorize('membership_edit');

        $data['business_directory'] = $business_directory;

        return view('admin.membership.business_directory.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBusinessDirectoryRequest $request, BusinessDirectory $business_directory)
    {
        $this->authorize('membership_edit');

        $validated = $request->validated();

        DB::transaction(function () use ($business_directory, $validated) {
            $business_directory->update([
                'name' => $validated['name'],
                'sub_name' => $validated['sub_name'],
                'status' => $validated['status'],
            ]);
        });

        return redirect()->route('admin.membership.business-directory.index')->with('success', 'Business Directory updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BusinessDirectory $business_directory)
    {
        $this->authorize('membership_delete');

        DB::transaction(function () use ($business_directory) {
            $business_directory->delete();
        });

        $data['error'] = false;
        $data['msg'] = 'Business Directory Deleted';

        return response()->json($data, 200);
    }

    public function statusToggle(UpdateBusinessDirectoryStatusRequest $request)
    {
        $this->authorize('membership_status_edit');

        $validated = $request->validated();

        $typeData = BusinessDirectory::find($validated['lid']);
        $status = $validated['lstatus'] == 1 ? '0' : '1';

        DB::transaction(function () use ($typeData, $status) {
            $typeData->update([
                'status' => $status
            ]);
        });

        $data['error'] = false;
        $data['msg'] = 'Business Directory status updated';

        return response()->json($data, 200);
    }
}
