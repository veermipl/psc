<?php

namespace App\Http\Controllers\admin;

use App\Traits\ImageTraits;
use Illuminate\Http\Request;
use App\Models\GuyanaEconomy;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Requests\admin\cms\CreateGERequest;
use App\Http\Requests\admin\cms\UpdateGERequest;
use App\Http\Requests\admin\cms\DeleteGEImageRequest;
use App\Http\Requests\admin\cms\ExportGERequest;
use App\Http\Requests\admin\cms\UpdateGEStatusRequest;

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
            if($value === $validated['img_url']){
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
}
