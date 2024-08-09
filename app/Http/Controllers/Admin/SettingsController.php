<?php

namespace App\Http\Controllers\admin;

use App\Models\Settings;
use App\Traits\ImageTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\admin\settings\UpdateEmailSettingsRequest;
use App\Http\Requests\admin\settings\UpdateGeneralSettingsRequest;
use App\Http\Requests\admin\settings\UpdateContactUsSettingsRequest;

class SettingsController extends Controller
{
    use ImageTraits;

    public function general()
    {
        $this->authorize('general_settings_edit');

        $settings = Settings::where('meta_type', 'general')->get();
        $data['settings'] = $settings->pluck('meta_value', 'meta_key')->toArray();

        return view('admin.settings.general', $data);
    }

    public function updateGeneral(UpdateGeneralSettingsRequest $request)
    {
        $this->authorize('general_settings_edit');

        $validated = $request->validated();

        $appLogo = $validated['app_logo_old'] ?? null;
        if ($request->hasFile('app_logo')) {
            $file = $request->file('app_logo');

            $appLogo = $file->store('settings', 'public');

            if($request->filled('app_logo_old')){
                $this->deleteFromStorage('public', $validated['app_logo_old'], $isArray = false);
            }
        }
        $validated['app_logo'] = $appLogo;
        unset($validated['app_logo_old']);

        DB::transaction(function () use ($validated) {
            foreach ($validated as $vKey => $value) {
                Settings::updateOrCreate(
                    ['meta_key' => $vKey],
                    ['meta_value' => $value, 'meta_type' => 'general']
                );
            }
        });

        return redirect()->route('admin.settings.general')->with('success', 'General Settings Updated');
    }

    public function email()
    {
        $this->authorize('email_settings_edit');

        $settings = Settings::where('meta_type', 'email')->get();
        $data['settings'] = $settings->pluck('meta_value', 'meta_key')->toArray();

        return view('admin.settings.email', $data);
    }

    public function updateEmail(UpdateEmailSettingsRequest $request)
    {
        $this->authorize('email_settings_edit');

        $validated = $request->validated();

        DB::transaction(function () use ($validated) {
            foreach ($validated as $vKey => $value) {
                Settings::updateOrCreate(
                    ['meta_key' => $vKey],
                    ['meta_value' => $value, 'meta_type' => 'email']
                );
            }
        });

        return redirect()->route('admin.settings.email')->with('success', 'Email Settings Updated');
    }

    public function contactUs()
    {
        $this->authorize('contact_us_settings_edit');

        $settings = Settings::where('meta_type', 'contact_us')->get();
        $data['settings'] = $settings->pluck('meta_value', 'meta_key')->toArray();

        return view('admin.settings.contact_us', $data);
    }

    public function updateContactUs(UpdateContactUsSettingsRequest $request)
    {
        $this->authorize('contact_us_settings_edit');

        $validated = $request->validated();

        DB::transaction(function () use ($validated) {
            foreach ($validated as $vKey => $value) {
                Settings::updateOrCreate(
                    ['meta_key' => $vKey],
                    ['meta_value' => $value, 'meta_type' => 'contact_us']
                );
            }
        });

        return redirect()->route('admin.settings.contact-us')->with('success', 'Contact Us Updated');
    }
}
