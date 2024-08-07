<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Models\GuyanaEconomy;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Requests\admin\cms\CreateGERequest;
use App\Http\Requests\admin\cms\UpdateGERequest;
use App\Http\Requests\admin\cms\UpdateGEStatusRequest;

class CMSController extends Controller
{
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

        $images = null;
        if ($request->hasFile('images')) {
            // $file = $request->file('form_pdf');

            // $images = $file->store('uploaded_forms', 'public');
        }
        $validated['images'] = $images;

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

    public function guyanaEconomyShow()
    {
        $this->authorize('cms_view');

        return view('admin.cms.guyana_economy.show');
    }

    public function guyanaEconomyEdit($id)
    {
        $this->authorize('cms_edit');

        $data['ge_data'] = GuyanaEconomy::find($id);

        return view('admin.cms.guyana_economy.edit', $data);
    }

    public function guyanaEconomyUpdate(UpdateGERequest $request)
    {
        $this->authorize('cms_edit');

        $validated = $request->validated();

        $images = null;
        if ($request->hasFile('images')) {
            // $file = $request->file('form_pdf');

            // $images = $file->store('uploaded_forms', 'public');
        }
        $validated['images'] = $images;

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

        $this->authorize('member_delete');

        $ge_data = GuyanaEconomy::findOrFail($id);

        DB::transaction(function () use ($ge_data) {
            $ge_data->delete();
        });

        $data['error'] = false;
        $data['msg'] = 'Deleted';

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
        $data['msg'] = 'Updated';

        return response()->json($data, 200);
    }

    public function guyanaEconomyExport(Request $request)
    {
        $this->authorize('cms_export');

        dd($request->all());
    }
}
