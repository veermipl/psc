<?php

namespace App\Http\Controllers\admin;

use App\Models\News;
use App\Traits\ImageTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Requests\admin\media\news\StoreNewsRequest;
use App\Http\Requests\admin\media\news\UpdateNewsRequest;
use App\Http\Requests\admin\media\news\DeleteNewsFileRequest;
use App\Http\Requests\admin\media\news\UpdateNewsStatusRequest;

class NewsController extends Controller
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

        $list = News::orderBy('id', 'desc')
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

        return view('admin.media.news.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('media_create');

        return view('admin.media.news.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNewsRequest $request)
    {
        $this->authorize('media_create');

        $validated = $request->validated();

        $allFiles= [];
        if ($request->hasFile('files')) {
            $files = $request->file('files');

            foreach ($files as $filesKey => $fileValue) {
                $path = $fileValue->store('media/news', 'public');
                array_push($allFiles, $path);
            }
        }
        $validated['files'] = (count($allFiles) > 0) ? implode(',', $allFiles) : null;

        DB::transaction(function () use ($validated) {
            $news = News::create([
                'title' => $validated['title'],
                'content' => $validated['content'],
                'files' => $validated['files'],
                'status' => $validated['status'],
            ]);
        });

        return redirect()->route('admin.media-center.news.index')->with('success', 'News created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(News $news)
    {
        $this->authorize('media_view');

        $data['news'] = $news;

        return view('admin.media.news.view', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(News $news)
    {
        $this->authorize('media_edit');

        $data['news'] = $news;

        return view('admin.media.news.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNewsRequest $request, News $news)
    {
        $this->authorize('media_edit');

        $validated = $request->validated();

        $allFiles = $validated['old_files'] ?? [];
        if ($request->hasFile('files')) {
            $files = $request->file('files');

            foreach ($files as $fileKey => $fileValue) {
                $path = $fileValue->store('media/news', 'public');
                array_push($allFiles, $path);
            }
        }
        $validated['files'] = (count($allFiles) > 0) ? implode(',', $allFiles) : null;

        DB::transaction(function () use ($news, $validated) {
            $news->update([
                'title' => $validated['title'],
                'content' => $validated['content'],
                'files' => $validated['files'],
                'status' => $validated['status'],
            ]);
        });

        return redirect()->route('admin.media-center.news.index')->with('success', 'News updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(News $news)
    {
         $this->authorize('media_delete');

         DB::transaction(function () use ($news) {
            $news->delete();
        });

        $data['error'] = false;
        $data['msg'] = 'News Deleted';

        return response()->json($data, 200);
    }

    public function deleteFile(DeleteNewsFileRequest $request)
    {
        $this->authorize('media_delete');

        $validated = $request->validated();
        
        $news = News::findOrFail($validated['id']);
        $news_files = explode(',', $news->files);

        foreach ($news_files as $key => $value) {
            if($value === $validated['file_url']){
                $this->deleteFromStorage('public', $validated['file_url'], $isArray = false);
                unset($news_files[$key]);
            }
        }

        $news_files_new = (count($news_files) > 0) ? implode(',', $news_files) : '';

        DB::transaction(function () use ($news, $news_files_new) {
            $news->update([
                'files' => $news_files_new
            ]);
        });

        $data['error'] = false;
        $data['msg'] = 'Image Deleted';

        return response()->json($data, 200);
    }

    public function statusToggle(UpdateNewsStatusRequest $request)
    {
        $this->authorize('media_status_edit');

        $validated = $request->validated();

        $news = News::find($validated['lid']);
        $status = $validated['lstatus'] == 1 ? '0' : '1';

        DB::transaction(function () use ($news, $status) {
            $news->update([
                'status' => $status
            ]);
        });

        $data['error'] = false;
        $data['msg'] = 'News status updated';

        return response()->json($data, 200);
    }
}
