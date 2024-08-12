<?php

namespace App\Http\Controllers\admin;

use App\Models\Photos;
use App\Traits\ImageTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Requests\admin\media\photo\StorePhotoRequest;
use App\Http\Requests\admin\media\photo\UpdatePhotoRequest;
use App\Http\Requests\admin\media\photo\UpdatePhotoStatusRequest;

class PhotoController extends Controller
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

        $list = Photos::orderBy('id', 'desc')
            ->where(function (Builder $query) use ($filterValues, $request) {
                $query->when($request->filled('status'), function (Builder $q) use ($filterValues) {
                        $q->where('status', $filterValues['status']);
                    });
            })
            ->get();

        $data['filterValues'] = $filterValues;
        $data['list'] = $list;
        $data['export_id'] = $list->pluck('id')->toArray();

        return view('admin.media.photo.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('media_create');

        return view('admin.media.photo.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePhotoRequest $request)
    {
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
                'status' => $validated['status'],
            ]);
        });

        return redirect()->route('admin.media-center.photo.index')->with('success', 'Photo created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Photos $photo)
    {
        $this->authorize('media_view');

        $data['photo'] = $photo;

        return view('admin.media.photo.view', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Photos $photo)
    {
        $this->authorize('media_edit');

        $data['photo'] = $photo;

        return view('admin.media.photo.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePhotoRequest $request, Photos $photo)
    {
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

        DB::transaction(function () use ($photo, $validated) {
            $photo->update([
                'name' => $validated['name'],
                'status' => $validated['status'],
            ]);
        });

        return redirect()->route('admin.media-center.photo.index')->with('success', 'Photo updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Photos $photo)
    {
         $this->authorize('media_delete');

         DB::transaction(function () use ($photo) {
            $photo->delete();
        });

        $data['error'] = false;
        $data['msg'] = 'Photo Deleted';

        return response()->json($data, 200);
    }

    public function statusToggle(UpdatePhotoStatusRequest $request)
    {
        $this->authorize('media_status_edit');

        $validated = $request->validated();

        $photo = Photos::find($validated['lid']);
        $status = $validated['lstatus'] == 1 ? '0' : '1';

        DB::transaction(function () use ($photo, $status) {
            $photo->update([
                'status' => $status
            ]);
        });

        $data['error'] = false;
        $data['msg'] = 'Photo status updated';

        return response()->json($data, 200);
    }
}
