<?php

namespace App\Http\Controllers\admin;

use App\Models\Albums;
use App\Traits\ImageTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Requests\admin\media\album\StoreAlbumRequest;
use App\Http\Requests\admin\media\album\UpdateAlbumRequest;
use App\Http\Requests\admin\media\album\UpdateAlbumStatusRequest;

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
                        $q->where('name', 'like', '%'.$filterValues['title'].'%');
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
    public function store(StoreAlbumRequest $request)
    {
        $this->authorize('media_create');
        
        $validated = $request->validated();

        $image= null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');

            $path = $image->store('media/album', 'public');
            $image = $path;
        }
        $validated['image'] = $image;

        DB::transaction(function () use ($validated) {
            Albums::create([
                'name' => $validated['title'],
                'image' => $validated['image'],
                'status' => $validated['status'],
            ]);
        });

        return redirect()->route('admin.media-center.album.index')->with('success', 'Album created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Albums $album)
    {
        $this->authorize('media_view');

        $data['album'] = $album;

        return view('admin.media.album.view', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Albums $album)
    {
        $this->authorize('media_edit');

        $data['album'] = $album;

        return view('admin.media.album.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAlbumRequest $request, Albums $album)
    {
        $this->authorize('media_edit');
        
        $validated = $request->validated();

        $imageFile = $validated['old_image'] ?? null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');

            $path = $image->store('media/album', 'public');
            $imageFile = $path;

            if($request->filled('old_image')){
                $this->deleteFromStorage('public', $validated['old_image'], $isArray = false);
            }
        }
        $validated['image'] = $imageFile;

        DB::transaction(function () use ($album, $validated) {
            $album->update([
                'name' => $validated['title'],
                'image' => $validated['image'],
                'status' => $validated['status'],
            ]);
        });

        return redirect()->route('admin.media-center.album.index')->with('success', 'Album updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Albums $album)
    {
         $this->authorize('media_delete');

         DB::transaction(function () use ($album) {
            $album->delete();
        });

        $data['error'] = false;
        $data['msg'] = 'Album Deleted';

        return response()->json($data, 200);
    }

    public function statusToggle(UpdateAlbumStatusRequest $request)
    {
        $this->authorize('media_status_edit');

        $validated = $request->validated();

        $albums = Albums::find($validated['lid']);
        $status = $validated['lstatus'] == 1 ? '0' : '1';

        DB::transaction(function () use ($albums, $status) {
            $albums->update([
                'status' => $status
            ]);
        });

        $data['error'] = false;
        $data['msg'] = 'Status updated';

        return response()->json($data, 200);
    }
}
