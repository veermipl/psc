<?php

namespace App\Http\Controllers\Auth;

use App\Models\Role;
use App\Models\User;
use Illuminate\View\View;
use App\Traits\UserTraits;
use App\Models\Application;
use App\Models\MemberFiles;
use App\Traits\ImageTraits;
use Illuminate\Http\Request;
use App\Traits\SettingTraits;
use App\Models\MembershipType;
use Illuminate\Validation\Rules;
use App\Traits\NotificationTraits;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Storage;
use App\Mail\auth\SendMemberRegistrationMailToAdmin;

class RegisteredUserController extends Controller
{
    use UserTraits, SettingTraits, ImageTraits, NotificationTraits;

    /**
     * Display the registration view.
     */
    public function create(): View
    {
        // $membershipList = MembershipType::orderBy('name', 'asc')->where('status', '1')->get();
        // $data['membershipList'] = $membershipList;
        // return view('auth.register', $data);
        return view('member.registrations');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Validate the request
        // $validated = $request->validate([
        //     'name' => ['required', 'string', 'max:255'],
        //     'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
        //     'password' => ['required', 'confirmed', Rules\Password::defaults()],
        //     'number' => ['required', 'string', 'max:12'],
        //     'membership_type' => ['required'],
        //     'form_pdf' => ['required', 'mimes:pdf', 'max:2048'], // max size in KB
        //     'supporting_document' => ['required', 'array'],
        //     'supporting_document.*' => ['required', 'mimes:pdf', 'max:2048'],
        // ]);

         // dd($request->all());
        // Validate the request
        // $validated = $request->validate([
        //     'name' => ['required', 'string', 'max:255'],
        //     'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
        //     'password' => ['required', 'confirmed', Rules\Password::defaults()],
        //     'number' => ['required', 'string', 'max:12'],
        //     'membership_type' => ['required'],
        //     'form_pdf' => ['required', 'mimes:pdf', 'max:2048'], // max size in KB
        //     'supporting_document' => ['required', 'array'],
        //     'supporting_document.*' => ['required', 'mimes:pdf', 'max:2048'],
        // ]);

        $this->validate($request, [
            'applicationtypeid' => 'required',
            'name_of_business'  => 'required',
			'legal_status'  => 'required',
            'date_of_egistration'  => 'required',
            'sector'  => 'required',
			'No_of_employees'  => 'required',
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
            // 'supporting_document.*' => 'required|mimes:jpg,jpeg,gif,png,pdf',    
            'supporting_document' => 'required | array',
            'supporting_document.*' => 'required | mimes:jpg,jpeg,gif,png,pdf,docx',
           
	 ], [
		'applicationtypeid.required' => 'The application type is required.',
		'name_of_business.required' => 'Please provide the name of the business.',
		'legal_status.required' => 'The legal status field is mandatory.',
		'date_of_egistration.required' => 'Please specify the date of registration.',
		'sector.required' => 'Please choose the sector.',
		'No_of_employees.required' => 'Enter the number of employees.',
		'registered_office_address.required' => 'The office address is required.',
		'type_of_business.required' => 'Enter business/operation address',
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
        'supporting_document.*.required' => 'Please upload a document.',
        'supporting_document.*.mimes' => 'Each document must be a file of type: jpg, jpeg, gif, png, docx and pdf.'
	
	]);

    // dd($request->supporting_document);

    $your_expectation =  implode(',', $request->your_expectation) ;
    $contribute_towards =  implode(',', $request->contribute_towards) ;
    $references_name =  implode(',', $request->references_name) ;
    $references_address =  implode(',', $request->references_address) ;
    $references_name_of_business =  implode(',', $request->references_name_of_business) ;
    $references_tel_nos =  implode(',', $request->references_tel_nos) ;
    $references_email =  implode(',', $request->references_email) ;
    $references_website =  implode(',', $request->references_website) ;

  $user_id =  Application::create([
    
        'application_type_id' => $request->applicationtypeid,
        'name_of_business' => $request->name_of_business,
        'legal_status' => $request->legal_status,
        'date_of_egistration' => $request->date_of_egistration,
        'sector' => $request->sector,
        'No_of_employees' => $request->No_of_employees,
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
        'status'  => '1'
    ]);

        // $formPdfPath = null;
        // if ($request->hasFile('form_pdf')) {
        //     $file = $request->file('form_pdf');
        //     $formPdfPath = $file->store('uploaded_forms', 'public');
        // }

        $sDoc = [];
        if ($request->hasFile('supporting_document')) {
            $images = $request->file('supporting_document');
            foreach ($images as $imageKey => $image) {
                $path = $image->store('supporting_documents', 'public');
                array_push($sDoc, $path);
            }
        }

        $ids = $user_id->id;

        try {
            DB::transaction(function () use ($request , $sDoc, $ids) {
                $user = User::create([
                    'name' => $request->principal_name,
                    'member_id' => $ids,
                    'email' => $request->email,
                    'mobile_number' => $request->telephone_no,
                    'membership_type' => $request->applicationtypeid,
                      // 'form_pdf' => $formPdfPath,
                    'status' => '0',
                    // 'password' => Hash::make('12345'),
                ]);

                $user->role()->sync(Role::where('name', 'Member')->pluck('id')->toArray());
                $this->InitialUserRolePermission($user);

                if (count($sDoc) > 0) {
                    foreach ($sDoc as $sDocKey => $sDocValue) {
                        MemberFiles::create([
                            'user_id' => $user->id,
                            'file_name' => $sDocValue,
                        ]);
                    }
                }
                $admin_mail = $this->getSettings('admin_mail');
                if ($admin_mail) {
                    $user->load('membership');
                    Mail::to($admin_mail)->queue((new SendMemberRegistrationMailToAdmin($user))->afterCommit());
                }
                $this->logNotification('member_registration', $user);
                // event(new Registered($user));
                // Auth::login($user);
            });
        } catch (\Exception $e) {
            // if ($formPdfPath) {
            //     $this->deleteFromStorage('public', $sDoc, $isArray = false);
            // }
            if (count($sDoc) > 0) {
                $this->deleteFromStorage('public', $sDoc, $isArray = true);
            }
            Log::error('Error saving user: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Registration failed. Please try again.');
        }
        return redirect()->route('register')->with('statuss', 'Thank you for submitting your application. Your registration is currently under review by the Private Sector Commission of Guyana. Once your application is approved, we will notify you via email. Upon approval, you will gain access to the member\'s area and its resources. We appreciate your patience during this process.');
    }

}
