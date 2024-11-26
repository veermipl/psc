<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use App\Models\Albums;
use App\Models\AlbumPhotos;
use App\Traits\ImageTraits;

class AlbumController extends Controller
{
    use ImageTraits;

    public function index(Request $request)
    {
        $this->authorize('media');

        $filterValues = [
            'title' => $request->title ?? null,
            'status' => $request->status ?? null,
        ];

        $list = Albums::orderBy('id', 'desc')
            ->where(function (Builder $query) use ($filterValues, $request) {
                $query->when($request->filled('title'), function (Builder $q) use ($filterValues) {
                        $q->where('title', 'like', '%'.$filterValues['title'].'%');
                    })
                ->when($request->filled('status'), function (Builder $q) use ($filterValues) {
                        $q->where('status', $filterValues['status']);
                    });
            })
            ->get();

        $data['filterValues'] = $filterValues;
        $data['list'] = $list;
        $data['export_id'] = $list->pluck('id')->toArray();

        return view('admin.media.album.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('media_create');

        return view('admin.media.album.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePhotoRequest $request)
    {
        dd('store');
        $this->authorize('media_create');

        $validated = $request->validated();

        $image= null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');

            $path = $image->store('media/photo', 'public');
            $image = $path;
        }
        $validated['name'] = $image;

        DB::transaction(function () use ($validated) {
            Photos::create([
                'name' => $validated['name'],
                'title' => $validated['title'],
                'status' => $validated['status'],
            ]);
        });

        return redirect()->route('admin.media-center.photo.index')->with('success', 'Photo created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Albums $albums)
    {
        $this->authorize('media_view');

        $data['albums'] = $albums;

        return view('admin.media.album.view', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Albums $albums)
    {
        $this->authorize('media_edit');

        $data['albums'] = $albums;

        return view('admin.media.album.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePhotoRequest $request, Albums $albums)
    {
        dd('upsate');
        $this->authorize('media_edit');

        $validated = $request->validated();

        $imageFile = $validated['old_image'] ?? null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');

            $path = $image->store('media/photo', 'public');
            $imageFile = $path;

            if($request->filled('old_image')){
                $this->deleteFromStorage('public', $validated['old_image'], $isArray = false);
            }
        }
        $validated['name'] = $imageFile;

        DB::transaction(function () use ($albums, $validated) {
            $albums->update([
                'name' => $validated['name'],
                'title' => $validated['title'],
                'status' => $validated['status'],
            ]);
        });

        return redirect()->route('admin.media-center.photo.index')->with('success', 'Photo updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Albums $albums)
    {
        dd('destroy');
         $this->authorize('media_delete');

         DB::transaction(function () use ($photo) {
            $albums->delete();
        });

        $data['error'] = false;
        $data['msg'] = 'Album Deleted';

        return response()->json($data, 200);
    }

    public function statusToggle(UpdatePhotoStatusRequest $request)
    {
        dd('toggle');
        $this->authorize('media_status_edit');

        $validated = $request->validated();

        $photo = Album::find($validated['lid']);
        $status = $validated['lstatus'] == 1 ? '0' : '1';

        DB::transaction(function () use ($photo, $status) {
            $photo->update([
                'status' => $status
            ]);
        });

        $data['error'] = false;
        $data['msg'] = 'Status updated';

        return response()->json($data, 200);
    }
}
