<?php

namespace App\Http\Controllers\admin;

use App\Models\Role;
use App\Models\User;
use App\Traits\UserTraits;
use App\Models\MemberFiles;
use App\Traits\ImageTraits;
use Illuminate\Http\Request;
use App\Traits\SettingTraits;
use App\Models\MembershipType;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\Builder;
use App\Mail\admin\member\SendApprovedMailToMember;
use App\Http\Requests\admin\member\ExporMemberRequest;
use App\Http\Requests\admin\member\StoreMemberRequest;
use App\Http\Requests\admin\member\ImportMemberRequest;
use App\Http\Requests\admin\member\UpdateMemberRequest;
use App\Http\Requests\admin\member\DeleteMemberDocRequest;
use App\Http\Requests\admin\member\ImportAddMemberRequest;
use App\Mail\admin\member\SendMemberWelcomeRegistrationMail;
use App\Http\Requests\admin\member\UpdateMemberStatusRequest;

class MemberController extends Controller
{
    use UserTraits, SettingTraits, ImageTraits;

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
        $userList = User::with(['membership', 'supportingDoc'])->orderBy('id', 'desc')
            ->whereHas('role', function (Builder $x) {
                $x->where('role_id', 2);
            })
            ->where(function (Builder $query) use ($filterValues, $request) {
                $query->when($request->filled('name'), function (Builder $q) use ($filterValues) {
                    $q->where('name', 'like', '%' . $filterValues['name'] . '%');
                })
                    ->when($request->filled('email'), function (Builder $q) use ($filterValues) {
                        $q->where('email', 'email', '%' . $filterValues['email'] . '%');
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

    public function import(Request $request)
    {
        $this->authorize('member_import');

        return view('admin.member.import');
    }

    public function importSample()
    {
        $fileName = 'member_list_sample.csv';
        $memberData = [];

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );
        $columns = array('Name', 'Email', 'Mobile');

        $callback = function () use ($memberData, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            fputcsv($file, array('John Doe', 'johndoe@yopmail.com', '1234567890'));

            fclose($file);
        };
        return response()->stream($callback, 200, $headers);
    }

    public function importWithExcel(ImportMemberRequest $request)
    {
        $this->authorize('member_import');

        $validated = $request->validated();
        $data = [];

        if ($request->hasFile('excelDoc')) {
            $flag = false;
            $invalidRow = [];

            $file = $request->file('excelDoc');
            $file_data = fopen($file->getPathname(), 'r');
            fgetcsv($file_data);
            $line = 2;
            $row_id = 1;

            while ($row = fgetcsv($file_data)) {
                $info = [];

                // Validate each column
                if (empty($row[0]) || !isset($row[0]) || !is_string($row[0])) {
                    $invalidRow[] = "Invalid member name '" . htmlspecialchars($row[0] ?? '') . "' at line $line";
                    $flag = true;
                } else {
                    $info['name'] = $row[0];
                }

                if (empty($row[1]) || !isset($row[1]) || !filter_var($row[1], FILTER_VALIDATE_EMAIL)) {
                    $invalidRow[] = "Invalid member email '" . htmlspecialchars($row[1] ?? '') . "' at line $line";
                    $flag = true;
                } else {
                    if($this->mailExist($row[1])){
                        $invalidRow[] = "Email already exist! '" . htmlspecialchars($row[1] ?? '') . "' at line $line";
                        $flag = true;
                    }else{
                        $info['email'] = $row[1];
                    }
                }

                if (empty($row[2]) || !isset($row[2]) || !is_numeric($row[2])) {
                    $invalidRow[] = "Invalid member mobile '" . htmlspecialchars($row[2] ?? '') . "' at line $line";
                    $flag = true;
                } else {
                    $info['mobile'] = $row[2];
                }

                // if (empty($row[3]) || !isset($row[3]) || !in_array((string)$row[3], ['0', 0, '1', 1])) {
                //     $invalidRow[] = "Invalid member status value '" . htmlspecialchars($row[3] ?? '') . "' at line $line";
                //     $flag = true;
                // } else {
                //     $info['status'] = $row[3];
                // }

                $info['id'] = $row_id;

                $data['importedData'][] = $info;

                $line++;
                $row_id++;
            }

            // Check if any invalid row was found
            if ($flag) {
                $data['error'] = true;
                $data['msg'] = "";
                $data['invalidRow'] = $invalidRow;
            } else {
                $data['error'] = false;
                $data['msg'] = "";
                $data['invalidRow'] = $invalidRow;
            }
        } else {
            $data['status'] = false;
            $data['msg'] = "No file uploaded";
        }

        return response()->json($data);
    }

    public function importWithExcelAdd(ImportAddMemberRequest $request)
    {
        $this->authorize('member_import');

        $validated = $request->validated();

        $tableData = json_decode($validated['tableData'], true);

        if(count($tableData) > 0){
            foreach ($tableData as $key => $userData) {
                $genPwd = $this->generateRandomPassword(12);

                DB::transaction(function () use ($userData, $genPwd) {
                    $user = User::create([
                        'name' => $userData['name'],
                        'email' => $userData['email'],
                        'mobile_number' => $userData['mobile'],
                        'form_pdf' => null,
                        'status' => '0',
                        'password' => Hash::make($genPwd),
                    ]);
        
                    $user->role()->sync(Role::where('name', 'Member')->pluck('id')->toArray());
                    $this->InitialUserRolePermission($user);

                    $userData['password'] = $genPwd;
                    $userData['app_name'] = $this->getSettings('app_name') ?? config('app.name');
                    $userData['support_mail'] = $this->getSettings('email') ?? 'psc@support.com';

                    Mail::to($userData['email'])->queue((new SendMemberWelcomeRegistrationMail($userData))->afterCommit());

                    Session::flash("success", "Members Imported");
        
                });
            }

            $data['error'] = false;
            $data['msg'] = "Members Imported";
            $data['redirect'] = route('admin.member.index');
        }else{
            $data['error'] = true;
            $data['msg'] = "No data sent";
        }

        return response()->json($data);
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
        if ($request->hasFile('form')) {
            $file = $request->file('form');

            $formPdfPath = $file->store('uploaded_forms', 'public');
        }
        $validated['form'] = $formPdfPath;

        $sDoc = [];
        if ($request->hasFile('supporting_document')) {
            $images = $request->file('supporting_document');

            foreach ($images as $imageKey => $image) {
                $path = $image->store('supporting_documents', 'public');
                array_push($sDoc, $path);
            }
        }
        $validated['supporting_document'] = $sDoc;

        DB::transaction(function () use ($validated) {
            $user = User::create([
                'name' => $validated['name'],
                'membership_type' => $validated['membership_type'],
                'email' => $validated['email'],
                'mobile_number' => $validated['contact'],
                'form_pdf' => $validated['form'],
                'status' => $validated['status'],
                'password' => Hash::make($validated['password']),
            ]);

            $user->role()->sync(Role::where('name', 'Member')->pluck('id')->toArray());
            $this->InitialUserRolePermission($user);

            if (count($validated['supporting_document']) > 0) {
                foreach ($validated['supporting_document'] as $sDocKey => $sDocValue) {
                    MemberFiles::create([
                        'user_id' => $user->id,
                        'file_name' => $sDocValue,
                    ]);
                }
            }
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

        $data['user'] = $member->load('supportingDoc');
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

        $formPdfPath = $validated['old_form'] ?? null;
        if ($request->hasFile('form_pdf')) {
            $file = $request->file('form_pdf');

            $formPdfPath = $file->store('uploaded_forms', 'public');
        }
        $validated['form_pdf'] = $formPdfPath;

        $sDoc = $validated['old_doc'] ?? [];
        if ($request->hasFile('supporting_document')) {
            $images = $request->file('supporting_document');

            foreach ($images as $imageKey => $image) {
                $path = $image->store('supporting_documents', 'public');
                array_push($sDoc, $path);
            }
        }
        $validated['supporting_document'] = $sDoc;

        if ($request->has('password') && !is_null($request->input('password')) && $request->input('password') !== '') {
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

            if (count($validated['supporting_document']) > 0) {
                MemberFiles::where('user_id', $member->id)->delete();

                foreach ($validated['supporting_document'] as $sDocKey => $sDocValue) {
                    MemberFiles::create([
                        'user_id' => $member->id,
                        'file_name' => $sDocValue,
                    ]);
                }
            }
        });

        return redirect()->route('admin.member.index')->with('success', 'Member Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $member)
    {
        $this->authorize('member_delete');

        DB::transaction(function () use ($member) {
            $member->delete();
        });

        $data['error'] = false;
        $data['msg'] = 'Member Deleted';

        return response()->json($data, 200);
    }

    public function deleteDoc(DeleteMemberDocRequest $request)
    {
        $this->authorize('member_doc_delete');

        $validated = $request->validated();

        $user = User::findOrFail($validated['id']);
        $data['error'] = true;
        $data['msg'] = 'Failed to deleted';

        if ($validated['doc_type'] == 'form') {

            DB::transaction(function () use ($user) {
                $user->update([
                    'form_pdf' => null
                ]);
            });

            $this->deleteFromStorage('public', $validated['doc_url'], $isArray = false);

            $data['error'] = false;
            $data['msg'] = 'Document Deleted';
        }

        if ($validated['doc_type'] == 'supporting') {
            $doc_from_db = MemberFiles::where([
                'user_id' => $validated['id'],
                'file_name' => $validated['doc_url']
            ])->firstOrFail();

            DB::transaction(function () use ($doc_from_db) {
                $doc_from_db->delete();
            });

            $this->deleteFromStorage('public', $validated['doc_url'], $isArray = false);

            $data['error'] = false;
            $data['msg'] = 'Document Deleted';
        }

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

        if ($validated['ustatus'] == '0' && $user->email) {
            Mail::to($user->email)->queue(new SendApprovedMailToMember($user));
        }

        $data['error'] = false;
        $data['msg'] = 'Member status updated';

        return response()->json($data, 200);
    }
}
