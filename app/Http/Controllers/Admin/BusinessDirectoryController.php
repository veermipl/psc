<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Models\MembershipType;
use App\Models\BusinessDirectory;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\admin\membership\business_directory\ExportBusinessDirectoryRequest;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Requests\admin\membership\business_directory\StoreBusinessDirectoryRequest;
use App\Http\Requests\admin\membership\business_directory\UpdateBusinessDirectoryRequest;
use App\Http\Requests\admin\membership\business_directory\UpdateBusinessDirectoryStatusRequest;

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

        $membershipList = MembershipType::orderBy('name', 'asc')->get();

        $data['membershipList'] = $membershipList;

        return view('admin.membership.business_directory.create', $data);
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
                'type' => $validated['type'],
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

        $membershipList = MembershipType::orderBy('name', 'asc')->get();

        $data['membershipList'] = $membershipList;
        $data['business_directory'] = $business_directory;

        return view('admin.membership.business_directory.view', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BusinessDirectory $business_directory)
    {
        $this->authorize('membership_edit');

        $membershipList = MembershipType::orderBy('name', 'asc')->get();

        $data['membershipList'] = $membershipList;
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
                'type' => $validated['type'],
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
        $data['msg'] = 'Status updated';

        return response()->json($data, 200);
    }

    public function export(ExportBusinessDirectoryRequest $request)
    {
        $this->authorize('membership_export');

        $validated = $request->validated();

        $fileName = 'business_directory.csv';
        $noData = 'NA';
        $dataarray = array();
        $data_ids = explode(',', $validated['export_id']);

        $data = BusinessDirectory::orderBy('id', 'asc')->whereIn('id', $data_ids)->get();

        foreach ($data as $dataKey => $dataVal) {
            $membershipTypeData = $dataVal->membershipType ? $dataVal->membershipType->name : '';
            $statusData = $dataVal->status == 1 ? 'Active' : 'InActive';

            $dataarray[] = [
                'id' => $dataVal->id,
                'name' => $dataVal->name ?? $noData,
                'membership_type' => $membershipTypeData ?? $noData,
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
        $columns = array('ID', 'Name', 'Membership Type', 'Status');
        $callback = function () use ($dataarray, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($dataarray as $task) {
                $row['ID'] = $task['id'];
                $row['Name'] = $task['name'];
                $row['Membership Type'] = $task['membership_type'];
                $row['Status'] = $task['status'];

                fputcsv($file, array($row['ID'], $row['Name'], $row['Membership Type'], $row['Status']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
