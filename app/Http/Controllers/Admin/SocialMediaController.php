<?php

namespace App\Http\Controllers\admin;

use App\Models\SocialMedia;
use App\Traits\ImageTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\admin\media\social_media\StoreSocialMediaRequest;
use App\Http\Requests\admin\media\social_media\UpdateSocialMediaRequest;
use App\Http\Requests\admin\media\social_media\UpdateSocialMediaStatusRequest;
use Illuminate\Database\Eloquent\Builder;

class SocialMediaController extends Controller
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

        $list = SocialMedia::orderBy('id', 'desc')
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

        return view('admin.media.social_media.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('media_create');

        return view('admin.media.social_media.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSocialMediaRequest $request)
    {
        $this->authorize('media_create');

        $validated = $request->validated();
        dd($validated);

        DB::transaction(function () use ($validated) {
            SocialMedia::create([
                'status' => $validated['status'],
            ]);
        });

        return redirect()->route('admin.media-center.social-media.index')->with('success', 'Social Media created successfully');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function show(SocialMedia $social_media)
    {
        $this->authorize('media_view');

        $data['social_media'] = $social_media;

        return view('admin.media.social_media.view', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SocialMedia $social_media)
    {
        $this->authorize('media_edit');

        $data['social_media'] = $social_media;

        return view('admin.media.social_media.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSocialMediaRequest $request, SocialMedia $social_media)
    {
        $this->authorize('media_create');

        $validated = $request->validated();
        dd($validated);

        DB::transaction(function () use ($validated, $social_media) {
            $social_media->update([
                'status' => $validated['status'],
            ]);
        });

        return redirect()->route('admin.media-center.social-media.index')->with('success', 'Social Media updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SocialMedia $social_media)
    {
        $this->authorize('media_delete');

         DB::transaction(function () use ($social_media) {
            $social_media->delete();
        });

        $data['error'] = false;
        $data['msg'] = 'Social Media Deleted';

        return response()->json($data, 200);
    }

    public function statusToggle(UpdateSocialMediaStatusRequest $request)
    {
        $this->authorize('media_status_edit');

        $validated = $request->validated();
        dd($validated);

        $news = SocialMedia::find($validated['lid']);
        $status = $validated['lstatus'] == 1 ? '0' : '1';

        DB::transaction(function () use ($news, $status) {
            $news->update([
                'status' => $status
            ]);
        });

        $data['error'] = false;
        $data['msg'] = 'Status updated';

        return response()->json($data, 200);
    }
}
