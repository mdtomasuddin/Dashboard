<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Auth\SocialiteLoginRequest;
use App\Http\Resources\Api\V1\Auth\LoginUserResource;
use App\Services\Api\V1\Auth\SocialiteService;
use App\Traits\Api\V1\ApiResponse;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class SocialiteController extends Controller
{
    // ! Trait For API Response
    use ApiResponse;

    // ! Dependency Injection
    public function __construct(
        protected SocialiteService $socialiteService
    ) {}

    /**
     * Handle socialite authentication (Google, Facebook, Apple).
     */
    public function socialiteLogin(SocialiteLoginRequest $request): JsonResponse
    {
        try {
            // get validated data
            $token    = $request->validated('token');
            $provider = $request->validated('provider');
            $role     = $request->validated('role') ?: 'user';

            // call socialite service
            $result  = $this->socialiteService->loginWithSocialite($provider, $token, $role);
            $message = ! empty($result['was_recently_created']) ? 'User registered successfully.' : 'Login successful.';

            // return response
            return $this->success(new LoginUserResource($result), $message, 200);
        } catch (UnauthorizedHttpException $e) {
            return $this->unauthorized($e->getMessage());
        } catch (Exception $e) {
            Log::error('Socialite Login Error: ' . $e->getMessage());
            return $this->error('Something went wrong: ' . $e->getMessage(), 500);
        }
    }
}
