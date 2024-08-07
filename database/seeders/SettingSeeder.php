<?php

namespace Database\Seeders;

use App\Models\Settings;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (config('site.settings') as $setting) {
            Settings::create([
                'meta_key' => $setting['name'],
                'meta_value' => $setting['value']
            ]);
        }
    }
}
