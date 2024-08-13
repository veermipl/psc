<?php

namespace App\Http\Controllers\admin;

use App\Traits\ImageTraits;
use App\Models\PressRelease;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\admin\media\press_release\DeletePressReleaseFileRequest;
use App\Http\Requests\admin\media\press_release\StorePressReleaseRequest;
use App\Http\Requests\admin\media\press_release\UpdatePressReleaseRequest;
use App\Http\Requests\admin\media\press_release\UpdatePressReleaseStatusRequest;
use Illuminate\Database\Eloquent\Builder;

class PressReleaseController extends Controller
{
    use ImageTraits;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('media');

        $filterValues = [
            'title' => $request->title ?? null,
            'status' => $request->status ?? null,
        ];

        $list = PressRelease::orderBy('id', 'desc')
            ->where(function (Builder $query) use ($filterValues, $request) {
                $query->when($request->filled('title'), function (Builder $q) use ($filterValues) {
                    $q->where('title', 'like', '%' . $filterValues['title'] . '%');
                })
                    ->when($request->filled('status'), function (Builder $q) use ($filterValues) {
                        $q->where('status', $filterValues['status']);
                    });
            })
            ->get();

        $data['filterValues'] = $filterValues;
        $data['list'] = $list;
        $data['export_id'] = $list->pluck('id')->toArray();

        return view('admin.media.press_release.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('media_create');

        return view('admin.media.press_release.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePressReleaseRequest $request)
    {
        $this->authorize('media_create');

        $validated = $request->validated();

        $allFiles = [];
        if ($request->hasFile('files')) {
            $files = $request->file('files');

            foreach ($files as $filesKey => $fileValue) {
                $path = $fileValue->store('media/press_release', 'public');
                array_push($allFiles, $path);
            }
        }
        $validated['files'] = (count($allFiles) > 0) ? implode(',', $allFiles) : null;

        DB::transaction(function () use ($validated) {
            PressRelease::create([
                'title' => $validated['title'],
                'content' => $validated['content'],
                'files' => $validated['files'],
                'status' => $validated['status'],
            ]);
        });

        return redirect()->route('admin.media-center.press-release.index')->with('success', 'Press Release created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(PressRelease $press_release)
    {
        $this->authorize('media_view');

        $data['press_release'] = $press_release;

        return view('admin.media.press_release.view', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PressRelease $press_release)
    {
        $this->authorize('media_edit');

        $data['press_release'] = $press_release;

        return view('admin.media.press_release.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePressReleaseRequest $request, PressRelease $press_release)
    {
        $this->authorize('media_edit');

        $validated = $request->validated();

        $allFiles = $validated['old_files'] ?? [];
        if ($request->hasFile('files')) {
            $files = $request->file('files');

            foreach ($files as $fileKey => $fileValue) {
                $path = $fileValue->store('media/press_release', 'public');
                array_push($allFiles, $path);
            }
        }
        $validated['files'] = (count($allFiles) > 0) ? implode(',', $allFiles) : null;

        DB::transaction(function () use ($press_release, $validated) {
            $press_release->update([
                'title' => $validated['title'],
                'content' => $validated['content'],
                'files' => $validated['files'],
                'status' => $validated['status'],
            ]);
        });

        return redirect()->route('admin.media-center.press-release.index')->with('success', 'Press Release updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PressRelease $press_release)
    {
        $this->authorize('media_delete');

        DB::transaction(function () use ($press_release) {
            $press_release->delete();
        });

        $data['error'] = false;
        $data['msg'] = 'Press Release Deleted';

        return response()->json($data, 200);
    }

    public function deleteFile(DeletePressReleaseFileRequest $request)
    {
        $this->authorize('media_delete');

        $validated = $request->validated();

        $press_release = PressRelease::findOrFail($validated['id']);
        $press_release_files = explode(',', $press_release->files);

        foreach ($press_release_files as $key => $value) {
            if ($value === $validated['file_url']) {
                $this->deleteFromStorage('public', $validated['file_url'], $isArray = false);
                unset($press_release_files[$key]);
            }
        }

        $press_release_files_new = (count($press_release_files) > 0) ? implode(',', $press_release_files) : '';

        DB::transaction(function () use ($press_release, $press_release_files_new) {
            $press_release->update([
                'files' => $press_release_files_new
            ]);
        });

        $data['error'] = false;
        $data['msg'] = 'File Deleted';

        return response()->json($data, 200);
    }

    public function statusToggle(UpdatePressReleaseStatusRequest $request)
    {
        $this->authorize('media_status_edit');

        $validated = $request->validated();

        $news = PressRelease::find($validated['lid']);
        $status = $validated['lstatus'] == 1 ? '0' : '1';

        DB::transaction(function () use ($news, $status) {
            $news->update([
                'status' => $status
            ]);
        });

        $data['error'] = false;
        $data['msg'] = 'Press Release status updated';

        return response()->json($data, 200);
    }
}
