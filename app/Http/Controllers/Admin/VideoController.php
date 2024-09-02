<?php

namespace App\Http\Controllers\admin;

use App\Models\Videos;
use App\Traits\ImageTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\admin\media\video\StoreVideoRequest;
use App\Http\Requests\admin\media\video\UpdateVideoRequest;
use App\Http\Requests\admin\media\video\UpdateVideoStatusRequest;
use Illuminate\Database\Eloquent\Builder;

class VideoController extends Controller
{
    use ImageTraits;
    
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('media');

        $filterValues = [
            'status' => $request->status ?? null,
        ];

        $list = Videos::orderBy('id', 'desc')
            ->where(function (Builder $query) use ($filterValues, $request) {
                $query->when($request->filled('status'), function (Builder $q) use ($filterValues) {
                        $q->where('status', $filterValues['status']);
                    });
            })
            ->get();

        $data['filterValues'] = $filterValues;
        $data['list'] = $list;
        $data['export_id'] = $list->pluck('id')->toArray();

        return view('admin.media.video.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('media_create');

        return view('admin.media.video.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVideoRequest $request)
    {
        $this->authorize('media_create');

        $validated = $request->validated();

        $videoFile= null;
        if ($request->hasFile('video')) {
            $video = $request->file('video');

            $path = $video->store('media/video', 'public');
            $videoFile = $path;
        }
        $validated['name'] = $videoFile;

        DB::transaction(function () use ($validated) {
            Videos::create([
                'name' => $validated['name'],
                'link' => $validated['link'],
                'type' => $validated['type'],
                'status' => $validated['status'],
            ]);
        });

        return redirect()->route('admin.media-center.video.index')->with('success', 'Video created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Videos $video)
    {
        $this->authorize('media_view');

        $data['video'] = $video;

        return view('admin.media.video.view', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Videos $video)
    {
        $this->authorize('media_edit');

        $data['video'] = $video;

        return view('admin.media.video.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVideoRequest $request, Videos $video)
    {
        $this->authorize('media_edit');

        $validated = $request->validated();

        $videoFile = $validated['old_video'] ?? null;
        if ($request->hasFile('video')) {
            $video = $request->file('video');

            $path = $video->store('media/video', 'public');
            $videoFile = $path;

            if($request->filled('old_video')){
                $this->deleteFromStorage('public', $validated['old_video'], $isArray = false);
            }
        }
        $validated['name'] = $videoFile;

        DB::transaction(function () use ($video, $validated) {
            Videos::where('id', $validated['id'])->update([
                'name' => $validated['name'],
                'link' => $validated['link'],
                'type' => $validated['type'],
                'status' => $validated['status'],
            ]);
        });

        return redirect()->route('admin.media-center.video.index')->with('success', 'Video updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Videos $video)
    {
         $this->authorize('media_delete');

         DB::transaction(function () use ($video) {
            $video->delete();
        });

        $data['error'] = false;
        $data['msg'] = 'Video Deleted';

        return response()->json($data, 200);
    }

    public function statusToggle(UpdateVideoStatusRequest $request)
    {
        $this->authorize('media_status_edit');

        $validated = $request->validated();

        $video = Videos::find($validated['lid']);
        $status = $validated['lstatus'] == 1 ? '0' : '1';

        DB::transaction(function () use ($video, $status) {
            $video->update([
                'status' => $status
            ]);
        });

        $data['error'] = false;
        $data['msg'] = 'Status updated';

        return response()->json($data, 200);
    }
}
