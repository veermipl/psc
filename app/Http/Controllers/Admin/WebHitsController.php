<?php

namespace App\Http\Controllers\admin;

use App\Models\WebHits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;

class WebHitsController extends Controller
{
    public function index(Request $request)
    {
        // $this->authorize('notification');

        $filterValues = [
            'date_from' => $request->date_from ?? null,
            'date_to' => $request->date_to ?? null,
        ];

        $list = WebHits::orderBy('id', 'desc')
            ->where(function (Builder $query) use ($filterValues, $request) {
                $query->when($request->filled('date_from'), function (Builder $q) use ($filterValues) {
                    $q->whereDate('created_at', '>=', $filterValues['date_from']);
                })
                    ->when($request->filled('date_to'), function (Builder $q) use ($filterValues) {
                        $q->whereDate('created_at', '<=', $filterValues['date_to']);
                    });
            })
            ->get();

        $data['filterValues'] = $filterValues;
        $data['list'] = $list;
        $data['export_id'] = $list->pluck('id')->toArray();

        return view('admin.web_hits.index', $data);
    }

    public function truncateData()
    {
        WebHits::truncate();

        return redirect()->route('admin.system.web-hits.index')->with('success', 'Table Truncated');
    }
}
