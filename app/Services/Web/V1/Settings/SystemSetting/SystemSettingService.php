<?php

namespace App\Services\Web\V1\Settings\SystemSetting;

use App\Helpers\Helper;
use App\Http\Requests\Web\V1\Settings\SystemSetting\SystemSettingRequest;
use App\Models\SystemSetting;
use Illuminate\Database\Eloquent\Model;

class SystemSettingService
{
    // Update or create system settings
    public function updateOrCreate(SystemSettingRequest $request): Model
    {
        $setting = SystemSetting::first() ?? new SystemSetting;
        $validated = $request->validated();

        $data = [
            'title'               => $validated['title'] ?? $setting->title,
            'system_name'         => $validated['system_name'] ?? $setting->system_name,
            'email'               => $validated['email'] ?? $setting->email,
            'phone'               => $validated['phone'] ?? $setting->phone,
            'address'             => $validated['address'] ?? $setting->address,
            'copyright_text'      => $validated['copyright_text'] ?? $setting->copyright_text,
            'description'         => $validated['description'] ?? $setting->description,
            'timezone'            => $validated['timezone'] ?? $setting->timezone,
            'maintenance_mode'    => $request->has('maintenance_mode'),
            'maintenance_message' => $validated['maintenance_message'] ?? $setting->maintenance_message,
        ];

        // Handle logo upload
        if ($request->hasFile('logo')) {
            if ($setting->logo) {
                Helper::deleteFile($setting->logo);
            }
            $data['logo'] = Helper::uploadFile($request->file('logo'), 'system-setting');
        }

        // Handle favicon upload
        if ($request->hasFile('favicon')) {
            if ($setting->favicon) {
                Helper::deleteFile($setting->favicon);
            }
            $data['favicon'] = Helper::uploadFile($request->file('favicon'), 'system-setting');
        }

        return SystemSetting::updateOrCreate(
            ['id' => 1],
            $data
        );
    }
}
