<?php

namespace App\Traits;

use App\Models\Settings;

trait SettingTraits
{
    public function site_settings($settingsKey)
    {
        if ($settingsKey ?? false) {
            $settingVal = Settings::where('meta_key', '=', $settingsKey)->get()->pluck('meta_value')->first();

            if ($settingVal) {
                return $settingVal;
            } else {
                return null;
            }
        }
    }
}
