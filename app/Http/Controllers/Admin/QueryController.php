<?php

namespace App\Http\Controllers\admin;

use App\Models\Query;
use App\Traits\ImageTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\admin\query\DeleteQueryRequest;
use App\Http\Requests\admin\query\ExportQueryRequest;
use Illuminate\Database\Eloquent\Builder;

class QueryController extends Controller
{
    use ImageTraits;

    public function list_contactUs(Request $request)
    {
        $this->authorize('query');

        $filterValues = [
            'name' => $request->name ?? null,
            'email' => $request->email ?? null,
            'phone' => $request->phone ?? null,
            'created_at' => $request->date ?? null,
        ];

        $dataList = Query::orderBy('id', 'desc')->where('type', 'contact_us')
            ->where(function (Builder $query) use ($filterValues, $request) {
                $query->when($request->filled('name'), function (Builder $q) use ($filterValues) {
                    $q->where('name', 'like', '%' . $filterValues['name'] . '%');
                })
                ->when($request->filled('email'), function (Builder $q) use ($filterValues) {
                    $q->where('email', 'like', '%' . $filterValues['email'] . '%');
                })
                ->when($request->filled('phone'), function (Builder $q) use ($filterValues) {
                    $q->where('phone', 'like', '%' . $filterValues['phone'] . '%');
                })
                    ->when($request->filled('created_at'), function (Builder $q) use ($filterValues) {
                        $q->whereDate('created_at', $filterValues['created_at']);
                    });
            })
            ->get();

        $data['filterValues'] = $filterValues;
        $data['dataList'] = $dataList;
        $data['export_id'] = $dataList->pluck('id')->toArray();

        return view('admin.query.list_contact_us', $data);
    }

    public function view_contactUs($id)
    {
        $this->authorize('query_view');

        $data['query_data'] = Query::findOrFail($id);

        return view('admin.query.view_contact_us', $data);
    }

    public function delete(DeleteQueryRequest $request)
    {
        $this->authorize('query_delete');

        $validated = $request->validated();

        $query_data = Query::findOrFail($validated['lid']);

        DB::transaction(function () use ($query_data) {
            $query_data->delete();
        });

        $data['error'] = false;
        $data['msg'] = 'Deleted';

        return response()->json($data, 200);
    }

    public function export(ExportQueryRequest $request)
    {
        $this->authorize('query_export');

        $validated = $request->validated();

        $fileName = $validated['file_name'].'.csv';
        $noData = 'NA';
        $dataarray = array();
        $data_ids = explode(',', $validated['export_id']);

        $data = Query::orderBy('id', 'asc')->whereIn('id', $data_ids)->get();

        foreach ($data as $dataKey => $dataVal) {
            $dataarray[] = [
                'id' => $dataVal->id,
                'name' => $dataVal->name ?? $noData,    
                'email' => $dataVal->email ?? $noData,
                'phone' => $dataVal->phone ?? $noData,
                'message' => $dataVal->message ?? $noData,
                'date' => date('jS \o\f F Y', strtotime($dataVal->created_at)) ?? $noData,
            ];
        }

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );
        $columns = array('ID', 'Name', 'Email', 'Phone', 'Message', 'Date');
        $callback = function () use ($dataarray, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($dataarray as $task) {
                $row['ID'] = $task['id'];
                $row['Name'] = $task['name'];
                $row['Email'] = $task['email'];
                $row['Phone'] = $task['phone'];
                $row['Message'] = $task['message'];
                $row['Date'] = $task['date'];

                fputcsv($file, array($row['ID'], $row['Name'], $row['Email'], $row['Phone'], $row['Message'], $row['Date']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
