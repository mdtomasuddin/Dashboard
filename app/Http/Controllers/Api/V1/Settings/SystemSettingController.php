<?php

namespace App\Http\Controllers\Api\V1\Settings;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\Settings\SystemSetting\SystemSettingResource;
use App\Models\SystemSetting;
use App\Traits\Api\V1\ApiResponse;
use Exception;
use Illuminate\Http\JsonResponse;

class SystemSettingController extends Controller
{
    //Trait For Api Response
    use ApiResponse;

    /**
     * Display the system settings data.
     */
    public function index(): JsonResponse
    {
        try {
            //Database Query
            $systemSetting = SystemSetting::first();

            return $this->success(new SystemSettingResource($systemSetting), 'Data retrieved successfully.', 200);
        } catch (Exception $e) {
            return $this->error('Something went wrong: ' . $e->getMessage(), 500);
        }
    }
}
