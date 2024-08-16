<?php

namespace App\Http\Controllers\admin;

use App\Models\Coted;
use App\Traits\ImageTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Requests\admin\data\coted\UpdateCotedRequest;
use App\Http\Requests\admin\data\coted\CreateCotedEDRequest;
use App\Http\Requests\admin\data\coted\DeleteCotedEDRequest;
use App\Http\Requests\admin\data\coted\UpdateCotedEDRequest;
use App\Http\Requests\admin\data\coted\UpdateCotedEDStatusRequest;

class CotedController extends Controller
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

        $main = Coted::where('type', 'main')->first();
        $entrepreneurship_development = Coted::orderBy('id', 'desc')->where('type', 'entrepreneurship_development')->get();

        $data['tab'] = $request->filled('tab') ? $request->tab : 'main';
        $data['main'] = $main;
        $data['entrepreneurship_development'] = $entrepreneurship_development;
        $data['entrepreneurship_development_export_id'] = $entrepreneurship_development->pluck('id')->toArray();

        return view('admin.data.coted.index', $data);
    }

    public function update(UpdateCotedRequest $request)
    {
        $this->authorize('data_edit');

        $validated = $request->validated();

        $fileName = $validated['old_file'] ?? null;
        if ($request->hasFile('file')) {
            $file = $request->file('file');

            $fileName = $file->store('data/coted', 'public');

            if ($request->filled('old_file')) {
                $this->deleteFromStorage('public', $validated['old_file'], $isArray = false);
            }
        }
        $validated['file'] = $fileName;

        DB::transaction(function () use ($validated) {
            Coted::updateOrCreate(
                ['type' => $validated['type']],
                ['title' => $validated['title'], 'content' => $validated['content'], 'file' => $validated['file']]
            );
        });

        return redirect()->route('admin.data.coted')->with('success', 'Coted updated successfully');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createEntrepreneurshipDevelopment()
    {
        $this->authorize('data_create');

        return view('admin.data.coted.create_e_development');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function saveEntrepreneurshipDevelopment(CreateCotedEDRequest $request)
    {
        $this->authorize('data_create');

        $validated = $request->validated();

        $fileName = null;
        if ($request->hasFile('file')) {
            $file = $request->file('file');

            $fileName = $file->store('data/coted/entrepreneurship_development', 'public');
        }
        $validated['file'] = $fileName;

        DB::transaction(function () use ($validated) {
            Coted::create([
                'title' => $validated['title'],
                'content' => $validated['content'],
                'file' => $validated['file'],
                'type' => $validated['type'],
                'status' => $validated['status'],
            ]);
        });

        return redirect()->route('admin.data.coted', ['tab' => $validated['type']])->with('success', 'Entrepreneurship Development created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editEntrepreneurshipDevelopment($id)
    {
        $this->authorize('data_edit');

        $sourceData = Coted::where('id', $id)->firstOrFail();

        $data['source'] = $sourceData;

        return view('admin.data.coted.edit_e_development', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateEntrepreneurshipDevelopment(UpdateCotedEDRequest $request)
    {
        $this->authorize('data_edit');

        $validated = $request->validated();

        $fileName = $validated['old_file'] ?? null;
        if ($request->hasFile('file')) {
            $file = $request->file('file');

            $fileName = $file->store('data/coted/entrepreneurship_development', 'public');

            if ($request->filled('old_file')) {
                $this->deleteFromStorage('public', $validated['old_file'], $isArray = false);
            }
        }
        $validated['file'] = $fileName;

        DB::transaction(function () use ($validated) {
            Coted::where('id', $validated['source_id'])->update([
                'title' => $validated['title'],
                'content' => $validated['content'],
                'file' => $validated['file'],
                'type' => $validated['type'],
                'status' => $validated['status'],
            ]);
        });

        return redirect()->route('admin.data.coted', ['tab' => $validated['type']])->with('success', 'Entrepreneurship Development updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deleteEntrepreneurshipDevelopment(DeleteCotedEDRequest $request)
    {
        $this->authorize('data_delete');

        $validated = $request->validated();

        DB::transaction(function () use ($validated) {
            Coted::where('id', $validated['lid'])->delete();
        });

        $data['error'] = false;
        $data['msg'] = 'Entrepreneurship Development Deleted';

        return response()->json($data, 200);
    }

    public function updateEntrepreneurshipDevelopmentStatus(UpdateCotedEDStatusRequest $request)
    {
        $this->authorize('data_status_edit');

        $validated = $request->validated();

        $list = Coted::find($validated['lid']);
        $status = $validated['lstatus'] == 1 ? '0' : '1';

        DB::transaction(function () use ($list, $status) {
            $list->update([
                'status' => $status
            ]);
        });

        $data['error'] = false;
        $data['msg'] = 'Entrepreneurship Development status updated';

        return response()->json($data, 200);
    }
}
