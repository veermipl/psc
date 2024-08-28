<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\admin\notification\UpdateNotificationStatusRequest;
use App\Models\Notifications;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('notification');

        $filterValues = [
            'title' => $request->title ?? null,
            'status' => $request->status ?? null,
        ];

        $list = Notifications::orderBy('id', 'desc')->get();

        $data['filterValues'] = $filterValues;
        $data['list'] = $list;
        $data['export_id'] = $list->pluck('id')->toArray();

        return view('admin.notification.index', $data);
    }

    public function reloadTable()
    {
        $list = Notifications::orderBy('id', 'desc')->get();

        foreach ($list as $key => $value) {
            $value['key'] = $key + 1;
            $value['title'] = '<a href="' . $value['link'] . '" class="text-secondary">' . $value['title'] . '</a>';
            if ($value['read'] == 0) {
                $value['status'] = '<span class="badge alert-danger" id="listStatus" lid="' . $value['id'] . '" lstatus="' . $value['read'] . '" lrow="' . $key . '">Mark as read</span>';
            } else {
                $value['status'] = '<span class="badge alert-success" id="" lid="' . $value['id'] . '" lstatus="' . $value['read'] . '" lrow="' . $key . '">Read</span>';
            }
            $value['action'] = '<div class="tableOptions"><span class="text-danger" title="Delete" lid="' . $value['id'] . '" lrow="' . $key . '" id="deleteListBtn"><i class="fa fa-trash"></i></span></div>';
        }

        return response()->json($list, 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Notifications $notification)
    {
         $this->authorize('notification_delete');

        DB::transaction(function () use ($notification) {
            $notification->delete();
        });

        $data['error'] = false;
        $data['msg'] = 'Notification Deleted';

        return response()->json($data, 200);
    }

    public function markAsRead(UpdateNotificationStatusRequest $request)
    {
        $this->authorize('notification_status_edit');

        $validated = $request->validated();

        $notification = Notifications::find($validated['lid']);
        $status = $validated['lstatus'] == 1 ? '0' : '1';

        DB::transaction(function () use ($notification, $status) {
            $notification->update([
                'read' => $status
            ]);
        });

        $data['error'] = false;
        $data['msg'] = 'Status updated';

        return response()->json($data, 200);
    }

    public function markAllAsRead(Request $request)
    {
        DB::transaction(function () {
            Notifications::query()->update([
                'read' => '1',
            ]);
        });

        return redirect()->route('admin.dashboard')->with('success', 'All notifications marked as read');
    }
}
