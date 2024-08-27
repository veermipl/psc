<?php

namespace App\Http\Controllers\admin;

use App\Models\CaricomCET;
use App\Traits\ImageTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Requests\admin\data\caricom_cet\UpdateCaricomCETRequest;
use App\Http\Requests\admin\data\caricom_cet\CreateCaricomCETObjectiveRequest;
use App\Http\Requests\admin\data\caricom_cet\DeleteCaricomCETObjectiveRequest;
use App\Http\Requests\admin\data\caricom_cet\UpdateCaricomCETObjectiveRequest;
use App\Http\Requests\admin\data\caricom_cet\UpdateCaricomCETObjectiveStatusRequest;

class CaricomCETController extends Controller
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

        $main = CaricomCET::where('type', 'main')->first();
        $objectives = CaricomCET::orderBy('id', 'desc')->where('type', 'objective')->get();

        $data['tab'] = $request->filled('tab') ? $request->tab : 'main';
        $data['main'] = $main;
        $data['objectives'] = $objectives;
        $data['objective_export_id'] = $objectives->pluck('id')->toArray();

        return view('admin.data.caricom_cet.index', $data);
    }

    public function update(UpdateCaricomCETRequest $request)
    {
        $this->authorize('data_edit');

        $validated = $request->validated();

        $fileName = $validated['old_file'] ?? null;
        if ($request->hasFile('file')) {
            $file = $request->file('file');

            $fileName = $file->store('data/caricom_cet', 'public');

            if ($request->filled('old_file')) {
                $this->deleteFromStorage('public', $validated['old_file'], $isArray = false);
            }
        }
        $validated['file'] = $fileName;

        DB::transaction(function () use ($validated) {
            CaricomCET::updateOrCreate(
                ['type' => $validated['type']],
                ['title' => $validated['title'], 'content' => $validated['content'], 'file' => $validated['file']]
            );
        });

        return redirect()->route('admin.data.caricom-cet')->with('success', 'Caricom CET updated successfully');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createObjective()
    {
        $this->authorize('data_create');

        return view('admin.data.caricom_cet.create_objective');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function saveObjective(CreateCaricomCETObjectiveRequest $request)
    {
        $this->authorize('data_create');

        $validated = $request->validated();

        $fileName = null;
        if ($request->hasFile('file')) {
            $file = $request->file('file');

            $fileName = $file->store('data/caricom_cet/objective', 'public');
        }
        $validated['file'] = $fileName;

        DB::transaction(function () use ($validated) {
            CaricomCET::create([
                'title' => $validated['title'],
                'content' => $validated['content'],
                'file' => $validated['file'],
                'type' => $validated['type'],
                'status' => $validated['status'],
            ]);
        });

        return redirect()->route('admin.data.caricom-cet', ['tab' => $validated['type']])->with('success', 'Objective created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editObjective($id)
    {
        $this->authorize('data_edit');

        $sourceData = CaricomCET::where('id', $id)->firstOrFail();

        $data['source'] = $sourceData;

        return view('admin.data.caricom_cet.edit_objective', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateObjective(UpdateCaricomCETObjectiveRequest $request)
    {
        $this->authorize('data_edit');

        $validated = $request->validated();

        $fileName = $validated['old_file'] ?? null;
        if ($request->hasFile('file')) {
            $file = $request->file('file');

            $fileName = $file->store('data/caricom_cet/objective', 'public');

            if ($request->filled('old_file')) {
                $this->deleteFromStorage('public', $validated['old_file'], $isArray = false);
            }
        }
        $validated['file'] = $fileName;

        DB::transaction(function () use ($validated) {
            CaricomCET::where('id', $validated['source_id'])->update([
                'title' => $validated['title'],
                'content' => $validated['content'],
                'file' => $validated['file'],
                'type' => $validated['type'],
                'status' => $validated['status'],
            ]);
        });

        return redirect()->route('admin.data.caricom-cet', ['tab' => $validated['type']])->with('success', 'Objective updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deleteObjective(DeleteCaricomCETObjectiveRequest $request)
    {
        $this->authorize('data_delete');

        $validated = $request->validated();

        DB::transaction(function () use ($validated) {
            CaricomCET::where('id', $validated['lid'])->delete();
        });

        $data['error'] = false;
        $data['msg'] = 'Objective Deleted';

        return response()->json($data, 200);
    }

    public function updateObjectiveStatus(UpdateCaricomCETObjectiveStatusRequest $request)
    {
        $this->authorize('data_status_edit');

        $validated = $request->validated();

        $list = CaricomCET::find($validated['lid']);
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
