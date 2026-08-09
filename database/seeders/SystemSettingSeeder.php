<?php

namespace Database\Seeders;

use App\Models\SystemSetting;
use Illuminate\Database\Seeder;

class SystemSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SystemSetting::updateOrCreate(
            ['id' => 1],
            [
                'title'               => 'T Dashboard',
                'system_name'         => 'T Dashboard System',
                'email'               => 'admin@tdashboard.com',
                'phone'               => '+8801700000000',
                'address'             => 'Dhaka, Bangladesh',
                'copyright_text'      => '© 2026 T Dashboard. All rights reserved.',
                'description'         => 'Default System Settings Description for T Dashboard Administration System.',
                'logo'                => 'backend/assets/images/logo.png',
                'favicon'             => 'backend/assets/images/favicon.ico',
                'timezone'            => 'Asia/Dhaka',
                'maintenance_mode'    => false,
                'maintenance_message' => 'System is under maintenance. Please try again later.',
            ]
        );
    }
}
