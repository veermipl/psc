<?php

namespace App\Http\Controllers\admin;

use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\admin\settings\UpdateGeneralSettingsRequest;
use App\Http\Requests\admin\settings\UpdateContactUsSettingsRequest;

class SettingsController extends Controller
{
    public function general()
    {
        $this->authorize('general_settings_edit');

        $settings = Settings::get();
        $data['settings'] = $settings->pluck('meta_value', 'meta_key')->toArray();

        return view('admin.settings.general', $data);
    }

    public function updateGeneral(UpdateGeneralSettingsRequest $request)
    {
        $this->authorize('general_settings_edit');

        $validated = $request->validated();

        $appLogo = null;
        if ($request->hasFile('app_logo')) {
            $file = $request->file('app_logo');

            $appLogo = $file->store('settings', 'public');
        }
        $validated['app_logo'] = $appLogo;

        DB::transaction(function () use ($validated) {
            foreach ($validated as $vKey => $value) {
                Settings::updateOrInsert(
                    ['meta_key' => $vKey],
                    ['meta_value' => $value]
                );
            }
        });

        return redirect()->route('admin.settings.general')->with('success', 'General Settings Updated');
    }

    public function contactUs()
    {
        $this->authorize('contact_us_settings_edit');

        return view('admin.settings.contact_us');
    }

    public function updateContactUs(UpdateContactUsSettingsRequest $request)
    {
        $this->authorize('contact_us_settings_edit');

        $validated = $request->validated();
        dd($validated);

        DB::transaction(function () {
        });
    }
}
