<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WebHits;

class WebHitsController extends Controller
{
    public function index()
    {
        // $this->authorize('notification');

        $filterValues = [
            'title' => $request->title ?? null,
            'status' => $request->status ?? null,
        ];

        $list = WebHits::orderBy('id', 'desc')->get();

        $data['filterValues'] = $filterValues;
        $data['list'] = $list;
        $data['export_id'] = $list->pluck('id')->toArray();

        return view('admin.web_hits.index', $data);
    }

    public function reloadTable()
    {
        $list = WebHits::orderBy('id', 'desc')->get();

        foreach ($list as $key => $value) {
            $value['key'] = $key + 1;
            $value['ip_address'] = '';
            $value['visited_url'] = '';
        }

        return response()->json($list, 200);
    }
}
