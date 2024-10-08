<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\admin\membership\type\ExportMembershipTypeRequest;
use App\Http\Requests\admin\membership\type\StoreMembershipTypeRequest;
use App\Http\Requests\admin\membership\type\UpdateMembershipTypeRequest;
use Illuminate\Database\Eloquent\Builder;
use App\Models\MembershipType as MembershipTypeModel;
use App\Http\Requests\admin\membership\type\UpdateMembershipTypeStatusRequest;

class MembershipTypeController extends Controller
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
        $list = MembershipTypeModel::orderBy('id', 'desc')
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

        return view('admin.membership.type.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('membership_create');

        return view('admin.membership.type.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMembershipTypeRequest $request)
    {
        $this->authorize('membership_create');

        $validated = $request->validated();

        DB::transaction(function () use ($validated) {
            $type = MembershipTypeModel::create([
                'name' => $validated['name'],
                'status' => $validated['status'],
            ]);
        });

        return redirect()->route('admin.membership.type.index')->with('success', 'Membership type created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(MembershipTypeModel $type)
    {
        $this->authorize('membership_view');

        $data['type'] = $type;

        return view('admin.membership.type.view', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MembershipTypeModel $type)
    {
        $this->authorize('membership_edit');

        $data['type'] = $type;

        return view('admin.membership.type.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMembershipTypeRequest $request, MembershipTypeModel $type)
    {
        $this->authorize('membership_edit');

        $validated = $request->validated();

        DB::transaction(function () use ($type, $validated) {
            $type->update([
                'name' => $validated['name'],
                'status' => $validated['status'],
            ]);
        });

        return redirect()->route('admin.membership.type.index')->with('success', 'Membership type updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MembershipTypeModel $type)
    {
        $this->authorize('membership_delete');

        DB::transaction(function () use ($type) {
            $type->delete();
        });

        $data['error'] = false;
        $data['msg'] = 'Membership type Deleted';

        return response()->json($data, 200);
    }

    public function statusToggle(UpdateMembershipTypeStatusRequest $request)
    {
        $this->authorize('membership_status_edit');

        $validated = $request->validated();

        $typeData = MembershipTypeModel::find($validated['lid']);
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

    public function export(ExportMembershipTypeRequest $request)
    {
        $this->authorize('membership_export');

        $validated = $request->validated();

        $fileName = 'membership_type.csv';
        $noData = 'NA';
        $dataarray = array();
        $data_ids = explode(',', $validated['export_id']);

        $data = MembershipTypeModel::orderBy('id', 'asc')->whereIn('id', $data_ids)->get();

        foreach ($data as $dataKey => $dataVal) {
            $statusData = $dataVal->status == 1 ? 'Active' : 'InActive';

            $dataarray[] = [
                'id' => $dataVal->id,
                'name' => $dataVal->name ?? $noData,
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
        $columns = array('ID', 'Name', 'Status');
        $callback = function () use ($dataarray, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($dataarray as $task) {
                $row['ID'] = $task['id'];
                $row['Name'] = $task['name'];
                $row['Status'] = $task['status'];

                fputcsv($file, array($row['ID'], $row['Name'], $row['Status']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
