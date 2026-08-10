<?php

namespace App\Http\Controllers\Api\V1\Settings;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\Settings\SocialMedia\SocialMediaResource;
use App\Models\SocialMedia;
use App\Traits\Api\V1\ApiResponse;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SocialMediaController extends Controller
{
    // ! Trait For API Response
    use ApiResponse;

    /**
     * Display a listing of social media links.
     */
    public function index(Request $request): JsonResponse
    {
        try {
            // Request parameters
            $perPage = $request->query('per_page', 25);

            // Database Query
            $socialMedia = SocialMedia::orderBy('created_at', 'desc')->paginate($perPage);
            return $this->success(SocialMediaResource::collection($socialMedia), 'Data retrieved successfully.', 200, true);
        } catch (Exception $e) {
            return $this->error('Something went wrong: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Display the specified social media link details.
     */
    public function show(int $id): JsonResponse
    {
        try {
            // Database Query
            $socialMedia = SocialMedia::find($id);
            // Check exists
            if (! $socialMedia) {
                return $this->error('Data not found.', 404);
            }

            return $this->success(new SocialMediaResource($socialMedia), 'Data details retrieved successfully.', 200);
        } catch (Exception $e) {
            return $this->error('Something went wrong: ' . $e->getMessage(), 500);
        }
    }
}
