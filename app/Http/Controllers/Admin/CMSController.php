<?php

namespace App\Http\Controllers\admin;

use App\Models\LandingPage;
use App\Traits\ImageTraits;
use Illuminate\Http\Request;
use App\Models\GuyanaEconomy;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Requests\admin\cms\CreateGERequest;
use App\Http\Requests\admin\cms\ExportGERequest;
use App\Http\Requests\admin\cms\UpdateGERequest;
use App\Http\Requests\admin\cms\DeleteGEImageRequest;
use App\Http\Requests\admin\cms\UpdateGEStatusRequest;
use App\Http\Requests\admin\cms\landing_page\DeleteRequest;
use App\Http\Requests\admin\cms\landing_page\CreatePostRequest;
use App\Http\Requests\admin\cms\landing_page\UpdatePostRequest;
use App\Http\Requests\admin\cms\landing_page\CreateHeaderRequest;
use App\Http\Requests\admin\cms\landing_page\UpdateHeaderRequest;
use App\Http\Requests\admin\cms\landing_page\UpdateReportRequest;
use App\Http\Requests\admin\cms\landing_page\UpdateStatusRequest;
use App\Http\Requests\admin\cms\landing_page\UpdateAboutUsRequest;
use App\Http\Requests\admin\cms\landing_page\CreateSubHeaderRequest;
use App\Http\Requests\admin\cms\landing_page\UpdateSubHeaderRequest;
use App\Http\Requests\admin\cms\landing_page\CreateSectorCommitteeRequest;
use App\Http\Requests\admin\cms\landing_page\UpdateSectorCommitteeRequest;

class CMSController extends Controller
{
    use ImageTraits;

    public function guyanaEconomy(Request $request)
    {
        $this->authorize('cms');

        $filterValues = [
            'title' => $request->title ?? null,
            'status' => $request->status ?? null,
            'created_at' => $request->created_at ?? null,
        ];

        $dataList = GuyanaEconomy::orderBy('id', 'desc')
            ->where(function (Builder $query) use ($filterValues, $request) {
                $query->when($request->filled('title'), function (Builder $q) use ($filterValues) {
                    $q->where('title', 'like', '%' . $filterValues['title'] . '%');
                })
                    ->when($request->filled('created_at'), function (Builder $q) use ($filterValues) {
                        $q->whereDate('created_at', $filterValues['created_at']);
                    })
                    ->when($request->filled('status'), function (Builder $q) use ($filterValues) {
                        $q->where('status', $filterValues['status']);
                    });
            })
            ->get();

        $data['filterValues'] = $filterValues;
        $data['dataList'] = $dataList;
        $data['export_id'] = $dataList->pluck('id')->toArray();

        return view('admin.cms.guyana_economy.index', $data);
    }

    public function guyanaEconomyCreate()
    {
        $this->authorize('cms_create');

        return view('admin.cms.guyana_economy.create');
    }

    public function guyanaEconomyStore(CreateGERequest $request)
    {
        $this->authorize('cms_create');

        $validated = $request->validated();

        $allImages = [];
        if ($request->hasFile('images')) {
            $images = $request->file('images');

            foreach ($images as $imageKey => $image) {
                $path = $image->store('cms/ge', 'public');
                array_push($allImages, $path);
            }
        }
        $validated['images'] = (count($allImages) > 0) ? implode(',', $allImages) : null;

        DB::transaction(function () use ($validated) {
            GuyanaEconomy::create([
                'title' => $validated['title'],
                'content' => $validated['content'],
                'images' => $validated['images'],
                'status' => $validated['status'],
            ]);
        });

        return redirect()->route('admin.cms.guyana-economy')->with('success', 'Content Created');
    }

    public function guyanaEconomyShow($id)
    {
        $this->authorize('cms_view');

        $data['ge_data'] = GuyanaEconomy::findOrFail($id);

        return view('admin.cms.guyana_economy.show', $data);
    }

    public function guyanaEconomyEdit($id)
    {
        $this->authorize('cms_edit');

        $data['ge_data'] = GuyanaEconomy::findOrFail($id);

        return view('admin.cms.guyana_economy.edit', $data);
    }

    public function guyanaEconomyUpdate(UpdateGERequest $request)
    {
        $this->authorize('cms_edit');

        $validated = $request->validated();

        $allImages = $validated['old_images'] ?? [];
        if ($request->hasFile('images')) {
            $images = $request->file('images');

            foreach ($images as $imageKey => $image) {
                $path = $image->store('cms/ge', 'public');
                array_push($allImages, $path);
            }
        }
        $validated['images'] = (count($allImages) > 0) ? implode(',', $allImages) : null;

        DB::transaction(function () use ($validated) {
            GuyanaEconomy::where('id', $validated['id'])->update([
                'title' => $validated['title'],
                'content' => $validated['content'],
                'images' => $validated['images'],
                'status' => $validated['status'],
            ]);
        });

        return redirect()->route('admin.cms.guyana-economy')->with('success', 'Content Updated');
    }

    public function guyanaEconomyDelete(Request $request, $id)
    {
        $this->authorize('cms_delete');

        $ge_data = GuyanaEconomy::findOrFail($id);

        DB::transaction(function () use ($ge_data) {
            $ge_data->delete();
            $this->deleteFromStorage('public', explode(',', $ge_data->images), $isArray = true);
        });

        $data['error'] = false;
        $data['msg'] = 'Deleted';

        return response()->json($data, 200);
    }

    public function guyanaEconomyDeleteImage(DeleteGEImageRequest $request)
    {
        $this->authorize('cms_delete');

        $validated = $request->validated();

        $ge_data = GuyanaEconomy::findOrFail($validated['id']);
        $ge_data_images = explode(',', $ge_data->images);

        foreach ($ge_data_images as $key => $value) {
            if ($value === $validated['img_url']) {
                $this->deleteFromStorage('public', $validated['img_url'], $isArray = false);
                unset($ge_data_images[$key]);
            }
        }

        $ge_data_images_new = (count($ge_data_images) > 0) ? implode(',', $ge_data_images) : '';

        DB::transaction(function () use ($ge_data, $ge_data_images_new) {
            $ge_data->update([
                'images' => $ge_data_images_new
            ]);
        });

        $data['error'] = false;
        $data['msg'] = 'Image Deleted';

        return response()->json($data, 200);
    }

    public function guyanaEconomyStatusToggle(UpdateGEStatusRequest $request)
    {
        $this->authorize('cms_status_edit');

        $validated = $request->validated();

        $ge = GuyanaEconomy::find($validated['id']);
        $status = $validated['status'] == 1 ? '0' : '1';

        DB::transaction(function () use ($ge, $status) {
            $ge->update([
                'status' => $status
            ]);
        });

        $data['error'] = false;
        $data['msg'] = 'Status updated';

        return response()->json($data, 200);
    }

    public function guyanaEconomyExport(ExportGERequest $request)
    {
        $this->authorize('cms_export');

        $validated = $request->validated();

        $fileName = 'cms_guyana_economy.csv';
        $noData = 'NA';
        $dataarray = array();
        $data_ids = explode(',', $validated['export_id']);

        $data = GuyanaEconomy::orderBy('id', 'asc')->whereIn('id', $data_ids)->get();

        foreach ($data as $dataKey => $dataVal) {
            $statusData = $dataVal->status == 1 ? 'Active' : 'InActive';

            $dataarray[] = [
                'id' => $dataVal->id,
                'title' => $dataVal->title ?? $noData,
                'content' => $dataVal->content ?? $noData,
                'status' => $statusData,
            ];
        }

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );
        $columns = array('ID', 'Title', 'Content', 'Status');
        $callback = function () use ($dataarray, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($dataarray as $task) {
                $row['ID'] = $task['id'];
                $row['Title'] = $task['title'];
                $row['Content'] = $task['content'];
                $row['Status'] = $task['status'];

                fputcsv($file, array($row['ID'], $row['Title'], $row['Content'], $row['Status']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function landingPage(Request $request)
    {
        $this->authorize('cms');

        $header = LandingPage::orderBy('id', 'desc')->where('type', 'header')->get();
        $sub_header = LandingPage::orderBy('id', 'desc')->where('type', 'sub_header')->get();
        $about_us = LandingPage::where('type', 'about_us')->first();
        $sector_committees = LandingPage::orderBy('id', 'desc')->where('type', 'sector_committee')->get();
        $report = LandingPage::where('type', 'report')->first();
        $posts = LandingPage::orderBy('id', 'desc')->where('type', 'post')->get();

        $data['tab'] = $request->filled('tab') ? $request->tab : 'header';
        $data['header'] = $header;
        $data['sub_header'] = $sub_header;
        $data['about_us'] = $about_us;
        $data['sector_committees'] = $sector_committees;
        $data['report'] = $report;
        $data['posts'] = $posts;

        $data['header_export_id'] = $header->pluck('id')->toArray();
        $data['sub_header_export_id'] = $sub_header->pluck('id')->toArray();
        $data['sector_committee_export_id'] = $sector_committees->pluck('id')->toArray();
        $data['posts_export_id'] = $posts->pluck('id')->toArray();

        return view('admin.cms.landing_page.index', $data);
    }

    public function updateAboutUs(UpdateAboutUsRequest $request)
    {
        $this->authorize('cms_edit');

        $validated = $request->validated();

        $fileName = $validated['old_file'] ?? null;
        if ($request->hasFile('file')) {
            $file = $request->file('file');

            $fileName = $file->store('cms/landing_page/about_us', 'public');

            if ($request->filled('old_file')) {
                $this->deleteFromStorage('public', $validated['old_file'], $isArray = false);
            }
        }
        $validated['file'] = $fileName;

        DB::transaction(function () use ($validated) {
            LandingPage::updateOrCreate(
                [
                    'type' => $validated['type']
                ],
                [
                    'title' => $validated['title'],
                    'content' => $validated['content'],
                    'file' => $validated['file'],
                ]
            );
        });

        return redirect()->route('admin.cms.landing-page', ['tab' => $validated['type']])->with('success', 'About Us Updated');
    }

    public function updateReport(UpdateReportRequest $request)
    {
        $this->authorize('cms_edit');

        $validated = $request->validated();

        $fileName = $validated['old_file'] ?? null;
        if ($request->hasFile('file')) {
            $file = $request->file('file');

            $fileName = $file->store('cms/landing_page/report', 'public');

            if ($request->filled('old_file')) {
                $this->deleteFromStorage('public', $validated['old_file'], $isArray = false);
            }
        }
        $validated['file'] = $fileName;

        $iconName = $validated['old_icon'] ?? null;
        if ($request->hasFile('icon')) {
            $icon = $request->file('icon');

            $iconName = $icon->store('cms/landing_page/report', 'public');

            if ($request->filled('old_icon')) {
                $this->deleteFromStorage('public', $validated['old_icon'], $isArray = false);
            }
        }
        $validated['icon'] = $iconName;

        DB::transaction(function () use ($validated) {
            LandingPage::updateOrCreate(
                [
                    'type' => $validated['type']
                ],
                [
                    'title' => $validated['title'],
                    'content' => $validated['content'],
                    'file' => $validated['file'],
                    'link' => $validated['link'],
                    'icon' => $validated['icon'],
                ]
            );
        });

        return redirect()->route('admin.cms.landing-page', ['tab' => $validated['type']])->with('success', 'Report Updated');
    }

    public function createHeader()
    {
        $this->authorize('cms_create');

        return view('admin.cms.landing_page.create_header');
    }

    public function saveHeader(CreateHeaderRequest $request)
    {
        $this->authorize('cms_create');

        $validated = $request->validated();

        $fileName = null;
        if ($request->hasFile('file')) {
            $file = $request->file('file');

            $fileName = $file->store('cms/landing_page/header', 'public');
        }
        $validated['file'] = $fileName;

        DB::transaction(function () use ($validated) {
            LandingPage::create([
                'title' => $validated['title'],
                'content' => $validated['content'],
                'file' => $validated['file'],
                'type' => $validated['type'],
                'status' => $validated['status'],
            ]);
        });

        return redirect()->route('admin.cms.landing-page', ['tab' => $validated['type']])->with('success', 'Header created successfully');
    }

    public function editHeader($id)
    {
        $this->authorize('cms_edit');

        $sourceData = LandingPage::where('id', $id)->firstOrFail();

        $data['source'] = $sourceData;

        return view('admin.cms.landing_page.edit_header', $data);
    }

    public function updateHeader(UpdateHeaderRequest $request)
    {
        $this->authorize('cms_edit');

        $validated = $request->validated();

        $fileName = $validated['old_file'] ?? null;
        if ($request->hasFile('file')) {
            $file = $request->file('file');

            $fileName = $file->store('cms/landing_page/header', 'public');

            if ($request->filled('old_file')) {
                $this->deleteFromStorage('public', $validated['old_file'], $isArray = false);
            }
        }
        $validated['file'] = $fileName;

        DB::transaction(function () use ($validated) {
            LandingPage::where('id', $validated['source_id'])->update([
                'title' => $validated['title'],
                'content' => $validated['content'],
                'file' => $validated['file'],
                'type' => $validated['type'],
                'status' => $validated['status'],
            ]);
        });

        return redirect()->route('admin.cms.landing-page', ['tab' => $validated['type']])->with('success', 'Header updated successfully');
    }

    public function createSubHeader()
    {
        $this->authorize('cms_create');

        return view('admin.cms.landing_page.create_sub_header');
    }

    public function saveSubHeader(CreateSubHeaderRequest $request)
    {
        $this->authorize('cms_create');

        $validated = $request->validated();

        $fileName = null;
        if ($request->hasFile('file')) {
            $file = $request->file('file');

            $fileName = $file->store('cms/landing_page/sub_header', 'public');
        }
        $validated['file'] = $fileName;

        DB::transaction(function () use ($validated) {
            LandingPage::create([
                'title' => $validated['title'],
                'content' => $validated['content'],
                'file' => $validated['file'],
                'type' => $validated['type'],
                'status' => $validated['status'],
            ]);
        });

        return redirect()->route('admin.cms.landing-page', ['tab' => $validated['type']])->with('success', 'Sub Header created successfully');
    }

    public function editSubHeader($id)
    {
        $this->authorize('cms_edit');

        $sourceData = LandingPage::where('id', $id)->firstOrFail();

        $data['source'] = $sourceData;

        return view('admin.cms.landing_page.edit_sub_header', $data);
    }

    public function updateSubHeader(UpdateSubHeaderRequest $request)
    {
        $this->authorize('cms_edit');

        $validated = $request->validated();

        $fileName = $validated['old_file'] ?? null;
        if ($request->hasFile('file')) {
            $file = $request->file('file');

            $fileName = $file->store('cms/landing_page/sub_header', 'public');

            if ($request->filled('old_file')) {
                $this->deleteFromStorage('public', $validated['old_file'], $isArray = false);
            }
        }
        $validated['file'] = $fileName;

        DB::transaction(function () use ($validated) {
            LandingPage::where('id', $validated['source_id'])->update([
                'title' => $validated['title'],
                'content' => $validated['content'],
                'file' => $validated['file'],
                'type' => $validated['type'],
                'status' => $validated['status'],
            ]);
        });

        return redirect()->route('admin.cms.landing-page', ['tab' => $validated['type']])->with('success', 'Sub Header updated successfully');
    }

    public function createSectorCommittee()
    {
        $this->authorize('cms_create');

        return view('admin.cms.landing_page.create_sector_committee');
    }

    public function saveSectorCommittee(CreateSectorCommitteeRequest $request)
    {
        $this->authorize('cms_create');

        $validated = $request->validated();

        $fileName = null;
        if ($request->hasFile('file')) {
            $file = $request->file('file');

            $fileName = $file->store('cms/landing_page/sector_committee', 'public');
        }
        $validated['file'] = $fileName;

        DB::transaction(function () use ($validated) {
            LandingPage::create([
                'title' => $validated['title'],
                'content' => $validated['content'],
                'file' => $validated['file'],
                'type' => $validated['type'],
                'status' => $validated['status'],
            ]);
        });

        return redirect()->route('admin.cms.landing-page', ['tab' => $validated['type']])->with('success', 'Sector Committee created successfully');
    }

    public function editSectorCommittee($id)
    {
        $this->authorize('cms_edit');

        $sourceData = LandingPage::where('id', $id)->firstOrFail();

        $data['source'] = $sourceData;

        return view('admin.cms.landing_page.edit_sector_committee', $data);
    }

    public function updateSectorCommittee(UpdateSectorCommitteeRequest $request)
    {
        $this->authorize('cms_edit');

        $validated = $request->validated();

        $fileName = $validated['old_file'] ?? null;
        if ($request->hasFile('file')) {
            $file = $request->file('file');

            $fileName = $file->store('cms/landing_page/sector_committee', 'public');

            if ($request->filled('old_file')) {
                $this->deleteFromStorage('public', $validated['old_file'], $isArray = false);
            }
        }
        $validated['file'] = $fileName;

        DB::transaction(function () use ($validated) {
            LandingPage::where('id', $validated['source_id'])->update([
                'title' => $validated['title'],
                'content' => $validated['content'],
                'file' => $validated['file'],
                'type' => $validated['type'],
                'status' => $validated['status'],
            ]);
        });

        return redirect()->route('admin.cms.landing-page', ['tab' => $validated['type']])->with('success', 'Sector Committee updated successfully');
    }

    public function createPost()
    {
        $this->authorize('cms_create');

        return view('admin.cms.landing_page.create_post');
    }

    public function savePost(CreatePostRequest $request)
    {
        $this->authorize('cms_create');

        $validated = $request->validated();

        $fileName = null;
        if ($request->hasFile('file')) {
            $file = $request->file('file');

            $fileName = $file->store('cms/landing_page/post', 'public');
        }
        $validated['file'] = $fileName;

        DB::transaction(function () use ($validated) {
            LandingPage::create([
                'title' => $validated['title'],
                'content' => $validated['content'],
                'file' => $validated['file'],
                'type' => $validated['type'],
                'status' => $validated['status'],
            ]);
        });

        return redirect()->route('admin.cms.landing-page', ['tab' => $validated['type']])->with('success', 'Post created successfully');
    }

    public function editPost($id)
    {
        $this->authorize('cms_edit');

        $sourceData = LandingPage::where('id', $id)->firstOrFail();

        $data['source'] = $sourceData;

        return view('admin.cms.landing_page.edit_post', $data);
    }

    public function updatePost(UpdatePostRequest $request)
    {
        $this->authorize('cms_edit');

        $validated = $request->validated();

        $fileName = $validated['old_file'] ?? null;
        if ($request->hasFile('file')) {
            $file = $request->file('file');

            $fileName = $file->store('cms/landing_page/post', 'public');

            if ($request->filled('old_file')) {
                $this->deleteFromStorage('public', $validated['old_file'], $isArray = false);
            }
        }
        $validated['file'] = $fileName;

        DB::transaction(function () use ($validated) {
            LandingPage::where('id', $validated['source_id'])->update([
                'title' => $validated['title'],
                'content' => $validated['content'],
                'file' => $validated['file'],
                'type' => $validated['type'],
                'status' => $validated['status'],
            ]);
        });

        return redirect()->route('admin.cms.landing-page', ['tab' => $validated['type']])->with('success', 'Post updated successfully');
    }

    public function delete(DeleteRequest $request)
    {
        $this->authorize('cms_delete');

        $validated = $request->validated();

        $list = LandingPage::find($validated['lid']);

        DB::transaction(function () use ($list, $validated) {
            $list->delete();
        });

        $data['error'] = false;
        $data['msg'] = 'Header Deleted';

        return response()->json($data, 200);
    }

    public function updateStatus(UpdateStatusRequest $request)
    {
        $this->authorize('cms_status_edit');

        $validated = $request->validated();

        $list = LandingPage::find($validated['lid']);
        $status = $validated['lstatus'] == 1 ? '0' : '1';

        DB::transaction(function () use ($list, $status, $validated) {
            $list->update([
                'status' => $status
            ]);
        });

        $data['error'] = false;
        $data['msg'] = 'Status updated';

        return response()->json($data, 200);
    }
}
