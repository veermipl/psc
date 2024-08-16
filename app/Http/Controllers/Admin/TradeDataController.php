<?php

namespace App\Http\Controllers\admin;

use App\Models\TradeData;
use App\Traits\ImageTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Requests\admin\data\trade_data\UpdateTradeDataRequest;
use App\Http\Requests\admin\data\trade_data\CreateTradeDataTopCountryRequest;
use App\Http\Requests\admin\data\trade_data\CreateTradeDataTopPartnerRequest;
use App\Http\Requests\admin\data\trade_data\DeleteTradeDataTopCountryRequest;
use App\Http\Requests\admin\data\trade_data\DeleteTradeDataTopPartnerRequest;
use App\Http\Requests\admin\data\trade_data\UpdateTradeDataTopCountryRequest;
use App\Http\Requests\admin\data\trade_data\UpdateTradeDataTopPartnerRequest;
use App\Http\Requests\admin\data\trade_data\UpdateTradeDataTopCountryStatusRequest;
use App\Http\Requests\admin\data\trade_data\UpdateTradeDataTopPartnerStatusRequest;

class TradeDataController extends Controller
{
    use ImageTraits;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('data');

        $sourceFilterValues = [
            'status' => $request->source_status ?? null,
        ];

        $main = TradeData::where('type', 'main')->first();
        $top_partner = TradeData::orderBy('id', 'desc')->where('type', 'top_partner')->get();
        $top_country = TradeData::orderBy('id', 'desc')->where('type', 'top_country')->get();

        $data['tab'] = $request->filled('tab') ? $request->tab : 'main';
        $data['main'] = $main;
        $data['top_partner'] = $top_partner;
        $data['top_country'] = $top_country;
        $data['top_partner_export_id'] = $top_partner->pluck('id')->toArray();
        $data['top_country_export_id'] = $top_country->pluck('id')->toArray();

        return view('admin.data.trade_data.index', $data);
    }

    public function update(UpdateTradeDataRequest $request)
    {
        $this->authorize('data_edit');

        $validated = $request->validated();

        $fileName = $validated['old_file'] ?? null;
        if ($request->hasFile('file')) {
            $file = $request->file('file');

            $fileName = $file->store('data/trade_data', 'public');

            if ($request->filled('old_file')) {
                $this->deleteFromStorage('public', $validated['old_file'], $isArray = false);
            }
        }
        $validated['file'] = $fileName;

        DB::transaction(function () use ($validated) {
            TradeData::updateOrCreate(
                ['type' => $validated['type']],
                ['title' => $validated['title'], 'content' => $validated['content'], 'file' => $validated['file']]
            );
        });

        return redirect()->route('admin.data.trade-data')->with('success', 'Trade Data updated successfully');
    }

    public function createTopPartner()
    {
        $this->authorize('data_create');

        return view('admin.data.trade_data.create_top_partner');
    }

    public function saveTopPartner(CreateTradeDataTopPartnerRequest $request)
    {
        $this->authorize('data_create');

        $validated = $request->validated();

        $fileName = null;
        if ($request->hasFile('file')) {
            $file = $request->file('file');

            $fileName = $file->store('data/trade_data/top_partner', 'public');
        }
        $validated['file'] = $fileName;

        DB::transaction(function () use ($validated) {
            TradeData::create([
                'title' => $validated['title'],
                'content' => $validated['content'],
                'file' => $validated['file'],
                'type' => $validated['type'],
                'status' => $validated['status'],
            ]);
        });

        return redirect()->route('admin.data.trade-data', ['tab' => $validated['type']])->with('success', 'Top Partner created successfully');
    }

    public function editTopPartner($id)
    {
        $this->authorize('data_edit');

        $sourceData = TradeData::where('id', $id)->firstOrFail();

        $data['source'] = $sourceData;

        return view('admin.data.trade_data.edit_top_partner', $data);
    }

    public function updateTopPartner(UpdateTradeDataTopPartnerRequest $request)
    {
        $this->authorize('data_edit');

        $validated = $request->validated();

        $fileName = $validated['old_file'] ?? null;
        if ($request->hasFile('file')) {
            $file = $request->file('file');

            $fileName = $file->store('data/trade_data/top_partner', 'public');

            if ($request->filled('old_file')) {
                $this->deleteFromStorage('public', $validated['old_file'], $isArray = false);
            }
        }
        $validated['file'] = $fileName;

        DB::transaction(function () use ($validated) {
            TradeData::where('id', $validated['source_id'])->update([
                'title' => $validated['title'],
                'content' => $validated['content'],
                'file' => $validated['file'],
                'type' => $validated['type'],
                'status' => $validated['status'],
            ]);
        });

        return redirect()->route('admin.data.trade-data', ['tab' => $validated['type']])->with('success', 'Top Partner updated successfully');
    }

    public function deleteTopPartner(DeleteTradeDataTopPartnerRequest $request)
    {
        $this->authorize('data_delete');

        $validated = $request->validated();

        DB::transaction(function () use ($validated) {
            TradeData::where([
                'id' => $validated['lid'],
                'type' => $validated['ltype'],
            ])->delete();
        });

        $data['error'] = false;
        $data['msg'] = 'Top Partner Deleted';

        return response()->json($data, 200);
    }

    public function updateTopPartnerStatus(UpdateTradeDataTopPartnerStatusRequest $request)
    {
        $this->authorize('data_status_edit');

        $validated = $request->validated();

        $list = TradeData::find($validated['lid']);
        $status = $validated['lstatus'] == 1 ? '0' : '1';

        DB::transaction(function () use ($list, $status, $validated) {
            $list->update([
                'type' => $validated['ltype'],
                'status' => $status
            ]);
        });

        $data['error'] = false;
        $data['msg'] = 'Top Partner status updated';

        return response()->json($data, 200);
    }

    public function createTopCountry()
    {
        $this->authorize('data_create');

        return view('admin.data.trade_data.create_top_country');
    }

    public function saveTopCountry(CreateTradeDataTopCountryRequest $request)
    {
        $this->authorize('data_create');

        $validated = $request->validated();

        $fileName = null;
        if ($request->hasFile('file')) {
            $file = $request->file('file');

            $fileName = $file->store('data/trade_data/top_country', 'public');
        }
        $validated['file'] = $fileName;

        DB::transaction(function () use ($validated) {
            TradeData::create([
                'title' => $validated['title'],
                'content' => $validated['content'],
                'file' => $validated['file'],
                'type' => $validated['type'],
                'status' => $validated['status'],
            ]);
        });

        return redirect()->route('admin.data.trade-data', ['tab' => $validated['type']])->with('success', 'Top Country created successfully');
    }

    public function editTopCountry($id)
    {
        $this->authorize('data_edit');

        $sourceData = TradeData::where('id', $id)->firstOrFail();

        $data['source'] = $sourceData;

        return view('admin.data.trade_data.edit_top_country', $data);
    }

    public function updateTopCountry(UpdateTradeDataTopCountryRequest $request)
    {
        $this->authorize('data_edit');

        $validated = $request->validated();

        $fileName = $validated['old_file'] ?? null;
        if ($request->hasFile('file')) {
            $file = $request->file('file');

            $fileName = $file->store('data/trade_data/top_country', 'public');

            if ($request->filled('old_file')) {
                $this->deleteFromStorage('public', $validated['old_file'], $isArray = false);
            }
        }
        $validated['file'] = $fileName;

        DB::transaction(function () use ($validated) {
            TradeData::where('id', $validated['source_id'])->update([
                'title' => $validated['title'],
                'content' => $validated['content'],
                'file' => $validated['file'],
                'type' => $validated['type'],
                'status' => $validated['status'],
            ]);
        });

        return redirect()->route('admin.data.trade-data', ['tab' => $validated['type']])->with('success', 'Top Country updated successfully');
    }

    public function deleteTopCountry(DeleteTradeDataTopCountryRequest $request)
    {
        $this->authorize('data_delete');

        $validated = $request->validated();

        DB::transaction(function () use ($validated) {
            TradeData::where([
                'id' => $validated['lid'],
                'type' => $validated['ltype'],
            ])->delete();
        });

        $data['error'] = false;
        $data['msg'] = 'Top Country Deleted';

        return response()->json($data, 200);
    }

    public function updateTopCountryStatus(UpdateTradeDataTopCountryStatusRequest $request)
    {
        $this->authorize('data_status_edit');

        $validated = $request->validated();

        $list = TradeData::find($validated['lid']);
        $status = $validated['lstatus'] == 1 ? '0' : '1';

        DB::transaction(function () use ($list, $status, $validated) {
            $list->update([
                'type' => $validated['ltype'],
                'status' => $status
            ]);
        });

        $data['error'] = false;
        $data['msg'] = 'Top Country status updated';

        return response()->json($data, 200);
    }
}
