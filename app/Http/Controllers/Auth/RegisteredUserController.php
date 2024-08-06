<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\MembershipType;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Storage;

class RegisteredUserController extends Controller
{
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
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'number' => ['required', 'string', 'max:12'],
            'membership_type' => ['required'],
            'form_pdf' => ['required', 'mimes:pdf', 'max:2048'], // max size in KB
        ]);
        dd($validated);

        $formPdfPath = null;

        // Check if the form_pdf file is uploaded
        if ($request->hasFile('form_pdf')) {
            $file = $request->file('form_pdf');

            // Store the uploaded file and get its path
            $formPdfPath = $file->store('uploaded_forms', 'public');
        }

        // Create the user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'mobile_number' => $request->number,
            'password' => Hash::make($request->password),
            'membership_type' => $request->membership_type,
            'form_pdf' => $formPdfPath, // Save the path of the uploaded PDF
        ]);

        // Trigger the Registered event
        event(new Registered($user));

        // Log the user in
        //Auth::login($user);

        // Redirect to the register route with a success message
        return redirect()->route('register')->with('status', 'Thank you for submitting your application. Your registration is currently under review by the Private Sector Commission of Guyana. Once your application is approved, we will notify you via email. Upon approval, you will gain access to the member\'s area and its resources. We appreciate your patience during this process.');
    }
}
