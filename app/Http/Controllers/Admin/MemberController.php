<?php

namespace App\Http\Controllers\admin;

use App\Models\Role;
use App\Models\User;
use App\Models\MemberRole;
use App\Traits\UserTraits;
use App\Models\Application;
use App\Models\MemberFiles;
use App\Traits\ImageTraits;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Traits\SettingTraits;
use App\Models\MembershipType;
use App\Mail\user\PasswordUpdated;
use App\Traits\NotificationTraits;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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
use Barryvdh\DomPDF\Facade\Pdf;

class MemberController extends Controller
{
    use UserTraits, SettingTraits, ImageTraits, NotificationTraits;

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

        $membershipList = MembershipType::orderBy('name', 'asc')->where('status', '1')->get();

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
        $columns = array('Name', 'Email', 'Mobile', 'Membership Type');

        $callback = function () use ($memberData, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            fputcsv($file, array('John Doe', 'johndoe@yopmail.com', '1234567890', '1'));
            fputcsv($file, array('Jane Doe', 'janedoe@yopmail.com', '1122334455', '2'));
            fputcsv($file, array('Sam', 'sam21@yopmail.com', '5242456734', '2'));
            fputcsv($file, array('Mark', 'mark@yopmail.com', '9925461534', '1'));
            fputcsv($file, array('Johnny S', 'johnnyS@yopmail.com', '4913647322', '1'));

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
                    if ($this->mailExist($row[1])) {
                        $invalidRow[] = "Email already exist! '" . htmlspecialchars($row[1] ?? '') . "' at line $line";
                        $flag = true;
                    } else {
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
                if (empty($row[3]) || !isset($row[3])) {
                    $invalidRow[] = "Invalid membership type value '" . htmlspecialchars($row[3] ?? '') . "' at line $line";
                    $flag = true;
                } else {
                    $info['membership_type'] = $row[3];
                }

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

        if (count($tableData) > 0) {
            foreach ($tableData as $key => $userData) {
                $genPwd = $this->generateRandomPassword(12);

                DB::transaction(function () use ($userData, $genPwd) {
                    $user = User::create([
                        'name' => $userData['name'],
                        'email' => $userData['email'],
                        'mobile_number' => $userData['mobile'],
                        'membership_type' => $userData['membership_type'],
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
        } else {
            $data['error'] = true;
            $data['msg'] = "No data sent";
        }

        return response()->json($data);
    }

    public function export(ExporMemberRequest $request)
    {
        $this->authorize('member_export');

        $validated = $request->validated();

        $fileName = 'members.csv';
        $noData = 'NA';
        $dataarray = array();
        $user_ids = explode(',', $validated['export_id']);

        $users = User::orderBy('name', 'asc')->whereIn('id', $user_ids)->get();

        foreach ($users as $userKey => $user) {
            $membershipData = $user->membership;
            $statusData = $user->status;

            $dataarray[] = [
                'id' => $user->id,
                'name' => $user->name ?? $noData,
                'email' => $user->email ?? $noData,
                'mobile' => $user->mobile_number ?? $noData,
                'membership_type' => $membershipData->name ?? $noData,
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
        $columns = array('ID', 'Name', 'Email', 'Mobile', 'Membership', 'Status');
        $callback = function () use ($dataarray, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($dataarray as $task) {
                $row['ID'] = $task['id'];
                $row['Name'] = $task['name'];
                $row['Email'] = $task['email'];
                $row['Mobile'] = $task['mobile'];
                $row['Membership'] = $task['membership_type'];
                $row['Status'] = $task['status'];

                fputcsv($file, array($row['ID'], $row['Name'], $row['Email'], $row['Mobile'], $row['Membership'], $row['Status']));
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

            $userData = $validated;
            $userData['password'] = $validated['password'];
            $userData['app_name'] = $this->getSettings('app_name') ?? config('app.name');
            $userData['support_mail'] = $this->getSettings('email') ?? 'psc@support.com';

            Mail::to($userData['email'])->queue((new SendMemberWelcomeRegistrationMail($userData))->afterCommit());

            $this->logNotification('member_created', $user);
        });

        return redirect()->route('admin.member.index')->with('success', 'Member created successfully');
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
        if ($user == '') {
            $data['error'] = true;
            $data['msg'] = 'Failed to deleted';
            return response()->json($data, 200);
        }

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
        $data['msg'] = 'Status updated';

        return response()->json($data, 200);
    }

    public function registration()
    {
        $data = Application::with('user', 'busibessType', 'legalStatus', 'sector', 'corporate')->orderby('id', 'desc')->get();
        return view('admin.member.applications.index', compact('data'));
    }

    public function registrationDelete($id)
    {
        $user = Application::find($id);
        $user->delete();

        $data['error'] = false;
        $data['msg'] = 'Deleted ';

        return response()->json($data, 200);
    }

    public function registrationStatus(Request $request)
    {
        $user = Application::find($request->uid);
        $status = $request->ustatus == 1 ? '0' : '1';
        DB::transaction(function () use ($user, $status) {
            $user->update([
                'status' => $status
            ]);
        });
        $data['error'] = false;
        $data['msg'] = 'status updated';
        return response()->json($data, 200);
    }

    public function registrationView($id)
    {
        $data = Application::with('user', 'busibessType', 'legalStatus', 'sectors', 'corporate')->where('id', $id)->first();
        $docVal = MemberFiles::where('user_id', $data->user->id)->get();

        return view('admin.member.applications.view', compact('data', 'docVal', 'id'));
    }

    public function registrationEdit($id)
    {
        $data = Application::with('user')->where('id', $id)->first();
        $docVal = MemberFiles::where('user_id', $data->user->id)->pluck('file_name')->toArray();

        return view('admin.member.applications.edit', compact('data', 'docVal'));
    }

    public function registrationUpdate(Request $request, $id)
    {

        $this->validate($request, [
            'applicationtypeid' => 'required',
            'name_of_business'  => 'required',
            'legal_status'  => 'required',
            'date_of_egistration'  => 'required',
            'sector'  => 'required',
            'no_of_employees'  => 'required',
            'registered_office_address'  => 'required',
            'type_of_business'  => 'required',
            'telephone_no'  => 'required',
            'fax_no'  => 'required',
            'email'  => 'required',
            'website'  => 'required',
            'membership_id'  => 'required',
            'your_expectation.*'  => 'required',
            'contribute_towards.*'  => 'required',
            'state_briefly'  => 'required',
            'you_know_about'  => 'required',
            'references_name.*'  => 'required',
            'references_address.*'  => 'required',
            'references_name_of_business.*'  => 'required',
            'references_tel_nos.*'  => 'required',
            'references_email.*'  => 'required',
            'references_website.*'  => 'required',
            'principal_name'  => 'required',
            'principal_designation'  => 'required',
            'principal_signature'  => 'required',
            'principal_date'  => 'required',
            'status' => 'required',
            'role'  => 'required',
            'supporting_document.*'  => 'nullable|mimes:jpeg,jpg,png,pdf,docx',


        ], [
            'applicationtypeid.required' => 'The application type is required.',
            'name_of_business.required' => 'Please provide the name of the business.',
            'legal_status.required' => 'The legal status field is mandatory.',
            'date_of_egistration.required' => 'Please specify the date of registration.',
            'sector.required' => 'Please choose the sector.',
            'no_of_employees.required' => 'Enter the number of employees.',
            'registered_office_address.required' => 'The office address is required.',
            'type_of_business.required' => 'Please specify the type of business.',
            'telephone_no.required' => 'Please provide a telephone number.',
            'fax_no.required' => 'Fax number is required.',
            'email.required' => 'Please provide an email address.',
            'website.required' => 'Website is required.',
            'membership_id.required' => 'Please provide a membership ID.',
            'your_expectation.*.required' => 'Please specify your expectations.',
            'contribute_towards.*.required' => 'Please specify how you will contribute.',
            'state_briefly.required' => 'Please provide a brief statement.',
            'you_know_about.required' => 'How you know about us is required.',
            'references_name.*.required' => 'Name is required for all entries.',
            'references_address.*.required' => 'Address is required for all entries.',
            'references_name_of_business.*.required' => 'Business name is required for all entries.',
            'references_tel_nos.*.required' => 'Telephone number is required for all entries.',
            'references_email.*.required' => 'Email is required for all entries.',
            'references_website.*.required' => 'Website is required for all entries.',
            'principal_name.required' => 'The  name is required.',
            'principal_designation.required' => 'The  designation is required.',
            'principal_signature.required' => 'The  signature is required.',
            'principal_date.required' => 'Please provide the date.',
            'role.required' => 'Please select role.',
            'supporting_document.*.required' => 'document format type only jpg,jpeg,png,pdf,docx'

        ]);

        $password = Str::password(8, true, true, false, false);
        $your_expectation =  implode(',', $request->your_expectation);
        $contribute_towards =  implode(',', $request->contribute_towards);
        $references_name =  implode(',', $request->references_name);
        $references_address =  implode(',', $request->references_address);
        $references_name_of_business =  implode(',', $request->references_name_of_business);
        $references_tel_nos =  implode(',', $request->references_tel_nos);
        $references_email =  implode(',', $request->references_email);
        $references_website =  implode(',', $request->references_website);

        $data = Application::where('id', $id)->first();
        $user = User::where('member_id', $id)->first();

        $user_data = [
            'name' => $request->principal_name,
            'email' => $request->email,
            'mobile_number' => $request->telephone_no,
            'member_role' => $request->role,
            'status' => $request->status,
        ];

        if ($request->status == '1') {
            $user_data['password'] = Hash::make($password);
        }

        $sDoc = $request['old_doc'] ?? [];
        if ($request->has('supporting_document')) {
            $images = $request->file('supporting_document');
            foreach ($images as $imageKey => $image) {
                $path = $image->store('supporting_documents', 'public');
                array_push($sDoc, $path);
            }
        }
        if (is_array($sDoc) && count($sDoc) > 0) {
            MemberFiles::where('user_id', $user->id)->delete();
            foreach ($sDoc as $sDocValue) {
                MemberFiles::create([
                    'user_id' => $user->id,
                    'file_name' => $sDocValue,
                ]);
            }
        }

        $dataee =    $user->update($user_data);
        $array = ([
            //    'user_id' => $id,
            'application_type_id' => $request->applicationtypeid,
            'name_of_business' => $request->name_of_business,
            'legal_status' => $request->legal_status,
            'date_of_egistration' => $request->date_of_egistration,
            'sector' => $request->sector,
            'No_of_employees' => $request->no_of_employees,
            'registered_office_address' => $request->registered_office_address,
            'type_of_business' => $request->type_of_business,
            'telephone_no' => $request->telephone_no,
            'fax_no' => $request->fax_no,
            'email' => $request->email,
            'website' => $request->website,
            'membership_id' => $request->membership_id,
            'state_briefly' => $request->state_briefly,
            'you_know_about' => $request->you_know_about,
            'principal_name' => $request->principal_name,
            'principal_designation' => $request->principal_designation,
            'principal_signature' => $request->principal_signature,
            'principal_date' => $request->principal_date,
            'your_expectation' => $your_expectation,
            'contribute_towards' => $contribute_towards,
            'contribute_towards' => $contribute_towards,
            'references_name' => $references_name,
            'references_address' => $references_address,
            'references_name_of_business' => $references_name_of_business,
            'references_tel_nos' => $references_tel_nos,
            'references_email' => $references_email,
            'references_website' => $references_website,
        ]);

        $data->update($array);

        if ($request->status == '1' && $user->email) {
            $role = MemberRole::where('id', $request->role)->first('name');
            Log::info('Sending mail to ' . $user->email);
            Mail::to($user->email)->send(new PasswordUpdated($user, $password, $role));
            Log::info('Mail sent to ' . $user->email);
        }

        return redirect()->route('admin.member.index')->with('success', 'Update successfully');
    }

    protected function getRegistrationData($id)
    {
        $userData = User::with('supportingDoc')->where('member_id', $id)->firstOrFail();
        $data = Application::with('user', 'busibessType', 'legalStatus', 'sectors', 'corporate')->where('id', $id)->first();
        $docVal = MemberFiles::where('user_id', $data->user->id)->get();

        return compact('userData', 'data', 'docVal');
    }

    public function registrationPrint(Request $request, $id)
    {
        $data = $this->getRegistrationData($id);
        $data['isPrint'] = true;

        return view('admin.member.applications.pdf', $data);
    }

    public function registrationAsPdf(Request $request, $id)
    {
        $data = $this->getRegistrationData($id);
        $data['isPrint'] = false;

        $html = view('admin.member.applications.pdf', $data)->render();
        $pdf = Pdf::loadHTML($html);

        return $pdf->download('registration.pdf');
    }
}
