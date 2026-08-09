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
                'email'               => 'mdtomasuddin1@gmail.com',
                'phone'               => '+8801873050391',
                'address'             => 'Sirajganj, Dhaka, Bangladesh',
                'copyright_text'      => '© 2026 T Dashboard. All rights reserved.',
                'description'         => '',
                'logo'                => null,
                'favicon'             => null,
                'timezone'            => null,
                'maintenance_mode'    => false,
                'maintenance_message' => null,
            ]
        );
    }
}
