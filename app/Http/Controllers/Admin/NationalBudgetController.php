<?php

namespace App\Http\Controllers\admin;

use App\Traits\ImageTraits;
use Illuminate\Http\Request;
use App\Models\NationalBudget;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Requests\admin\data\national_budget\UpdateNationalBudgetRequest;
use App\Http\Requests\admin\data\national_budget\CreateNationalBudgetSourceRequest;
use App\Http\Requests\admin\data\national_budget\DeleteNationalBudgetSourceRequest;
use App\Http\Requests\admin\data\national_budget\UpdateNationalBudgetSourceRequest;
use App\Http\Requests\admin\data\national_budget\UpdateNationalBudgetSourceStatusRequest;

class NationalBudgetController extends Controller
{
    use ImageTraits;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('data');

        $sourceFilterValues = [
            'status' => $request->source_status ?? null,
        ];

        $main = NationalBudget::where('type', 'main')->first();
        $sources = NationalBudget::orderBy('id', 'desc')->where('type', 'source')->get();

        $data['tab'] = $request->filled('tab') ? $request->tab : 'main';
        $data['main'] = $main;
        $data['sources'] = $sources;
        $data['source_export_id'] = $sources->pluck('id')->toArray();

        return view('admin.data.national_budget.index', $data);
    }

    public function update(UpdateNationalBudgetRequest $request)
    {
        $this->authorize('data_edit');

        $validated = $request->validated();

        $fileName = $validated['old_file'] ?? null;
        if ($request->hasFile('file')) {
            $file = $request->file('file');

            $fileName = $file->store('data/national_budget', 'public');

            if ($request->filled('old_file')) {
                $this->deleteFromStorage('public', $validated['old_file'], $isArray = false);
            }
        }
        $validated['file'] = $fileName;

        DB::transaction(function () use ($validated) {
            NationalBudget::updateOrCreate(
                ['type' => $validated['type']],
                ['title' => $validated['title'], 'content' => $validated['content'], 'file' => $validated['file']]
            );
        });

        return redirect()->route('admin.data.national-budget')->with('success', 'National Budget updated successfully');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createSource()
    {
        $this->authorize('data_create');

        return view('admin.data.national_budget.create_source');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function saveSource(CreateNationalBudgetSourceRequest $request)
    {
        $this->authorize('data_create');

        $validated = $request->validated();

        $fileName = null;
        if ($request->hasFile('file')) {
            $file = $request->file('file');

            $fileName = $file->store('data/national_budget/source', 'public');
        }
        $validated['file'] = $fileName;

        DB::transaction(function () use ($validated) {
            NationalBudget::create([
                'title' => $validated['title'],
                'content' => $validated['content'],
                'file' => $validated['file'],
                'type' => $validated['type'],
                'status' => $validated['status'],
            ]);
        });

        return redirect()->route('admin.data.national-budget', ['tab' => $validated['type']])->with('success', 'Source created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editSource($id)
    {
        $this->authorize('data_edit');

        $sourceData = NationalBudget::where('id', $id)->firstOrFail();

        $data['source'] = $sourceData;

        return view('admin.data.national_budget.edit_source', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateSource(UpdateNationalBudgetSourceRequest $request)
    {
        $this->authorize('data_edit');

        $validated = $request->validated();

        $fileName = $validated['old_file'] ?? null;
        if ($request->hasFile('file')) {
            $file = $request->file('file');

            $fileName = $file->store('data/national_budget/source', 'public');

            if ($request->filled('old_file')) {
                $this->deleteFromStorage('public', $validated['old_file'], $isArray = false);
            }
        }
        $validated['file'] = $fileName;

        DB::transaction(function () use ($validated) {
            NationalBudget::where('id', $validated['source_id'])->update([
                'title' => $validated['title'],
                'content' => $validated['content'],
                'file' => $validated['file'],
                'type' => $validated['type'],
                'status' => $validated['status'],
            ]);
        });

        return redirect()->route('admin.data.national-budget', ['tab' => $validated['type']])->with('success', 'Source updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deleteSource(DeleteNationalBudgetSourceRequest $request)
    {
        $this->authorize('data_delete');

        $validated = $request->validated();

        DB::transaction(function () use ($validated) {
            NationalBudget::where('id', $validated['lid'])->delete();
        });

        $data['error'] = false;
        $data['msg'] = 'Source Deleted';

        return response()->json($data, 200);
    }

    public function updateSourceStatus(UpdateNationalBudgetSourceStatusRequest $request)
    {
        $this->authorize('data_status_edit');

        $validated = $request->validated();

        $list = NationalBudget::find($validated['lid']);
        $status = $validated['lstatus'] == 1 ? '0' : '1';

        DB::transaction(function () use ($list, $status) {
            $list->update([
                'status' => $status
            ]);
        });

        $data['error'] = false;
        $data['msg'] = 'Status updated';

        return response()->json($data, 200);
    }
}
