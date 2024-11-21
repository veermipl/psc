<?php

namespace App\Http\Controllers\admin;

use App\Traits\ImageTraits;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\ExecutiveCommitteess;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Requests\admin\about\executive_committee\StoreExecutiveCommitteeRequest;
use App\Http\Requests\admin\about\executive_committee\ExportExecutiveCommitteeRequest;
use App\Http\Requests\admin\about\executive_committee\UpdateExecutiveCommitteeRequest;
use App\Http\Requests\admin\about\executive_committee\UpdateExecutiveCommitteeStatusRequest;

class ExecutiveCommitteeController extends Controller
{
    use ImageTraits;
    
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('about_us');

        $filterValues = [
            'name' => $request->name ?? null,
            'status' => $request->status ?? null,
        ];
        $list = ExecutiveCommitteess::orderBy('id', 'desc')
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

        return view('admin.about.execuive_committee.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('about_us_create');

        return view('admin.about.execuive_committee.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreExecutiveCommitteeRequest $request)
    {
        $this->authorize('about_us_create');

        $validated = $request->validated();

        $fileName = null;
        if ($request->hasFile('profile')) {
            $file = $request->file('profile');

            $fileName = $file->store('about_us/executive_committee', 'public');
        }
        $validated['image'] = $fileName;

        DB::transaction(function () use ($validated) {
            ExecutiveCommitteess::create([
                'name' => $validated['name'],
                'image' => $validated['image'],
                'designation' => $validated['designation'],
                'terms_of_reference' => $validated['terms_of_reference'],
                'facebook' => $validated['facebook'],
                'twitter' => $validated['twitter'],
                'instagram' => $validated['instagram'],
                'dribble' => $validated['dribbble'],
                'status' => $validated['status'],
            ]);
        });

        return redirect()->route('admin.about-us.executive-committee.index')->with('success', 'Executive Committee Member created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(ExecutiveCommitteess $executive_committee)
    {
        $this->authorize('about_us_view');

        $data['date'] = $executive_committee;

        return view('admin.about.execuive_committee.view', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ExecutiveCommitteess $executive_committee)
    {
        $this->authorize('about_us_edit');

        $data['data'] = $executive_committee;

        return view('admin.about.execuive_committee.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateExecutiveCommitteeRequest $request, ExecutiveCommitteess $executive_committee)
    {
        $this->authorize('about_us_edit');

        $validated = $request->validated();

        $fileName = $validated['old_profile'] ?? null;
        if ($request->hasFile('profile')) {
            $file = $request->file('profile');

            $fileName = $file->store('about_us/executive_committee', 'public');

            if ($request->filled('old_profile')) {
                $this->deleteFromStorage('public', $validated['old_profile'], $isArray = false);
            }
        }
        $validated['image'] = $fileName;

        DB::transaction(function () use ($executive_committee, $validated) {
            $executive_committee->update([
                'name' => $validated['name'],
                'image' => $validated['image'],
                'designation' => $validated['designation'],
                'terms_of_reference' => $validated['terms_of_reference'],
                'facebook' => $validated['facebook'],
                'twitter' => $validated['twitter'],
                'instagram' => $validated['instagram'],
                'dribble' => $validated['dribbble'],
                'status' => $validated['status'],
            ]);
        });

        return redirect()->route('admin.about-us.executive-committee.index')->with('success', 'Executive Committee Member updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ExecutiveCommitteess $executive_committee)
    {
        $this->authorize('about_us_delete');

        DB::transaction(function () use ($executive_committee) {
            $executive_committee->delete();
        });

        $data['error'] = false;
        $data['msg'] = 'Executive Committee Member Deleted';

        return response()->json($data, 200);
    }

    public function statusToggle(UpdateExecutiveCommitteeStatusRequest $request)
    {
        $this->authorize('about_us_status_edit');

        $validated = $request->validated();

        $typeData = ExecutiveCommitteess::find($validated['lid']);
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

    public function export(ExportExecutiveCommitteeRequest $request)
    {
        $this->authorize('about_us_export');

        $validated = $request->validated();

        $fileName = 'executive_committee.csv';
        $noData = 'NA';
        $dataarray = array();
        $data_ids = explode(',', $validated['export_id']);

        $data = ExecutiveCommitteess::orderBy('id', 'asc')->whereIn('id', $data_ids)->get();

        foreach ($data as $dataKey => $dataVal) {
            $statusData = $dataVal->status == 1 ? 'Active' : 'InActive';

            $dataarray[] = [
                'id' => $dataVal->id,
                'name' => $dataVal->name ?? $noData,
                'designation' => $dataVal->name ?? $noData,
                'facebook' => $dataVal->facebook ?? $noData,
                'twitter' => $dataVal->twitter ?? $noData,
                'instagram' => $dataVal->instagram ?? $noData,
                'dribbble' => $dataVal->dribbble ?? $noData,
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
        $columns = array('ID', 'Name', 'Designation', 'Facebook', 'Twitter', 'Instagram', 'Dribbble', 'Status');
        $callback = function () use ($dataarray, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($dataarray as $task) {
                $row['ID'] = $task['id'];
                $row['Name'] = $task['name'];
                $row['Designation'] = $task['designation'];
                $row['Facebook'] = $task['facebook'];
                $row['Twitter'] = $task['twitter'];
                $row['Instagram'] = $task['instagram'];
                $row['Dribbble'] = $task['dribbble'];
                $row['Status'] = $task['status'];

                fputcsv($file, array($row['ID'], $row['Name'], $row['Designation'], $row['Facebook'], $row['Twitter'], $row['Instagram'], $row['Dribbble'], $row['Status']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
