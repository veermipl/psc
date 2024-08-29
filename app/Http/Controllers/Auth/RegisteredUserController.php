<?php

namespace App\Http\Controllers\Auth;

use App\Models\Role;
use App\Models\User;
use Illuminate\View\View;
use App\Traits\UserTraits;
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
        $membershipList = MembershipType::orderBy('name', 'asc')->get();

        $data['membershipList'] = $membershipList;

        return view('auth.register', $data);
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Validate the request
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'number' => ['required', 'string', 'max:12'],
            'membership_type' => ['required'],
            'form_pdf' => ['required', 'mimes:pdf', 'max:2048'], // max size in KB
            'supporting_document' => ['required', 'array'],
            'supporting_document.*' => ['required', 'mimes:pdf', 'max:2048'],
        ]);

        $formPdfPath = null;
        if ($request->hasFile('form_pdf')) {
            $file = $request->file('form_pdf');

            $formPdfPath = $file->store('uploaded_forms', 'public');
        }

        $sDoc = [];
        if ($request->hasFile('supporting_document')) {
            $images = $request->file('supporting_document');

            foreach ($images as $imageKey => $image) {
                $path = $image->store('supporting_documents', 'public');
                array_push($sDoc, $path);
            }
        }

        try {
            DB::transaction(function () use ($request, $formPdfPath, $sDoc) {

                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'mobile_number' => $request->number,
                    'membership_type' => $request->membership_type,
                    'form_pdf' => $formPdfPath,
                    'status' => '0',
                    'password' => Hash::make($request->password),
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
                    dd($user);
                    Mail::to($admin_mail)->queue((new SendMemberRegistrationMailToAdmin($user))->afterCommit());
                }

                $this->logNotification('member_registration', $user);

                // event(new Registered($user));

                // Auth::login($user);
            });
        } catch (\Exception $e) {
            if ($formPdfPath) {
                $this->deleteFromStorage('public', $formPdfPath, $isArray = false);
            }

            if (count($sDoc) > 0) {
                $this->deleteFromStorage('public', $sDoc, $isArray = true);
            }

            Log::error('Error saving user: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Registration failed. Please try again.');
        }

        return redirect()->route('register')->with('statuss', 'Thank you for submitting your application. Your registration is currently under review by the Private Sector Commission of Guyana. Once your application is approved, we will notify you via email. Upon approval, you will gain access to the member\'s area and its resources. We appreciate your patience during this process.');
    }
}
