<?php

namespace App\Http\Controllers\Web\V1\Settings\SystemSetting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\V1\Settings\SystemSetting\SystemSettingRequest;
use App\Models\SystemSetting;
use App\Services\Web\V1\Settings\SystemSetting\SystemSettingService;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class SystemSettingController extends Controller
{
    // SystemSettingController constructor
    public function __construct(
        protected SystemSettingService $systemSettingService
    ) {}

    // Display the System Settings edit form
    public function index(): View
    {
        $setting = SystemSetting::first();

        return view('backend.settings.system-setting.index', [
            'setting' => $setting,
        ]);
    }

    // Update or create System Settings
    public function store(SystemSettingRequest $request): RedirectResponse
    {
        try {
            $this->systemSettingService->updateOrCreate($request);

            return redirect()->route('system-setting.index')->with('t-success', 'System settings updated successfully.');
        } catch (Exception $e) {
            return redirect()->route('system-setting.index')->with('t-error', 'Failed to update system settings. Please try again.');
        }
    }
}
