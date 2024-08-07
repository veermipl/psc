<?php

namespace App\Http\Controllers\admin;

use App\Models\Role;
use App\Models\User;
use App\Traits\UserTraits;
use Illuminate\Http\Request;
use App\Models\MembershipType;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Requests\admin\member\ExporMemberRequest;
use App\Http\Requests\admin\member\StoreMemberRequest;
use App\Http\Requests\admin\member\UpdateMemberRequest;
use App\Http\Requests\admin\member\UpdateMemberStatusRequest;

class MemberController extends Controller
{
    use UserTraits;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('member_list');

        $filterValues = [
            'name' => $request->name ?? null,
            'email' => $request->email ?? null,
            'membership_type' => $request->membership_type ?? null,
            'role' => $request->role ?? null,
            'status' => $request->status ?? null,
        ];
        $userList = User::with(['membership'])->orderBy('id', 'desc')
            ->whereHas('role', function (Builder $x) {
                $x->where('role_id', 2);
            })
            ->where(function (Builder $query) use ($filterValues, $request) {
                $query->when($request->filled('name'), function (Builder $q) use ($filterValues) {
                    $q->where('name', 'like', '%' . $filterValues['name'] . '%');
                })
                    ->when($request->filled('email'), function (Builder $q) use ($filterValues) {
                        $q->where('email', $filterValues['email']);
                    })
                    ->when($request->filled('membership_type'), function (Builder $q) use ($filterValues) {
                        $q->where('membership_type', $filterValues['membership_type']);
                    })
                    ->when($request->filled('role'), function (Builder $q) use ($filterValues) {
                        $q->whereHas('role', function (Builder $x) use ($filterValues) {
                            $x->where('role_id', $filterValues['role']);
                        });
                    })
                    ->when($request->filled('status'), function (Builder $q) use ($filterValues) {
                        $q->where('status', $filterValues['status']);
                    });
            })
            ->get();

        $membershipList = MembershipType::orderBy('name', 'asc')->get();

        $data['filterValues'] = $filterValues;
        $data['userList'] = $userList;
        $data['export_id'] = $userList->pluck('id')->toArray();
        $data['membershipList'] = $membershipList;

        return view('admin.member.index', $data);
    }

    public function export(ExporMemberRequest $request)
    {
        $this->authorize('member_export');

        $validated = $request->validated();

        $fileName = 'user_data.csv';
        $noData = 'NA';
        $dataarray = array();
        $user_ids = explode(',', $validated['export_id']);

        $users = User::orderBy('name', 'asc')->where('id', $user_ids)->get();

        foreach ($users as $userKey => $user) {
            $userRoles = $user->role ? $user->role->pluck('name')->toArray() : [];
            $membershipData = $user->membership_type;
            $statusData = $user->status;

            $dataarray[] = [
                'id' => $user->id,
                'name' => $user->name ?? $noData,
                'email' => $user->email ?? $noData,
                'mobile' => $user->mobile_number ?? $noData,
                'membership_type' => $membershipData ?? $noData,
                'role' => implode(', ', $userRoles),
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
        $columns = array('ID', 'Name', 'Email', 'Mobile', 'Membership', 'Role', 'Status');
        $callback = function () use ($dataarray, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($dataarray as $task) {
                $row['ID'] = $task['id'];
                $row['Name'] = $task['name'];
                $row['Email'] = $task['email'];
                $row['Mobile'] = $task['mobile'];
                $row['Membership'] = $task['membership_type'];
                $row['Role'] = $task['role'];
                $row['Status'] = $task['status'];

                fputcsv($file, array($row['ID'], $row['Name'], $row['Email'], $row['Mobile'], $row['Membership'], $row['Role'], $row['Status']));
            }

            fclose($file);
        };
        return response()->stream($callback, 200, $headers);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('member_create');

        $data['membershipList'] = MembershipType::orderBy('name', 'asc')->get();

        return view('admin.member.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMemberRequest $request)
    {
        $this->authorize('member_create');

        $validated = $request->validated();

        $formPdfPath = null;
        if ($request->hasFile('form_pdf')) {
            $file = $request->file('form_pdf');

            $formPdfPath = $file->store('uploaded_forms', 'public');
        }
        $validated['form_pdf'] = $formPdfPath;

        DB::transaction(function () use ($validated) {
            $user = User::create([
                'name' => $validated['name'],
                'membership_type' => $validated['membership_type'],
                'email' => $validated['email'],
                'mobile_number' => $validated['contact'],
                'form_pdf' => $validated['form_pdf'],
                'status' => $validated['status'],
                'password' => Hash::make($validated['password']),
            ]);

            $user->role()->sync(Role::where('name', 'Member')->pluck('id')->toArray());
            $this->InitialUserRolePermission($user);
        });

        return redirect()->route('admin.member.index')->with('status', 'Member created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $member)
    {
        $this->authorize('user_view');

        $data['user'] = $member;

        return view('admin.member.view', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $member)
    {
        $this->authorize('member_edit');

        $data['user'] = $member;
        $data['membershipList'] = MembershipType::orderBy('name', 'asc')->get();

        return view('admin.member.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMemberRequest $request, User $member)
    {
        $this->authorize('member_edit');

        $validated = $request->validated();

        $formPdfPath = null;
        if ($request->hasFile('form_pdf')) {
            $file = $request->file('form_pdf');

            $formPdfPath = $file->store('uploaded_forms', 'public');
        }
        $validated['form_pdf'] = $formPdfPath;

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            $validated['password'] = $member->password;
        }

        DB::transaction(function () use ($member, $validated) {
            $member->update([
                'name' => $validated['name'],
                'membership_type' => $validated['membership_type'],
                // 'email' => $validated['email'],
                'mobile_number' => $validated['contact'],
                'form_pdf' => $validated['form_pdf'],
                'password' => $validated['password'],
                'status' => $validated['status'],
            ]);
        });

        return redirect()->route('admin.member.index')->with('success', 'Member Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $member)
    {
        $this->authorize('member_delete');
        return $member;

        DB::transaction(function () use ($member) {
            $member->delete();
        });

        $data['error'] = false;
        $data['msg'] = 'Member Deleted';

        return response()->json($data, 200);
    }

    public function statusToggle(UpdateMemberStatusRequest $request)
    {
        $this->authorize('member_status_edit');

        $validated = $request->validated();

        $user = User::find($validated['uid']);
        $status = $validated['ustatus'] == 1 ? '0' : '1';

        DB::transaction(function () use ($user, $status) {
            $user->update([
                'status' => $status
            ]);
        });

        $data['error'] = false;
        $data['msg'] = 'Member status updated';

        return response()->json($data, 200);
    }
}
