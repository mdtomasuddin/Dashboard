<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Auth\ChangePasswordRequest;
use App\Http\Requests\Api\V1\Auth\DeleteAccountRequest;
use App\Http\Resources\Api\V1\Auth\ChangePasswordResource;
use App\Http\Resources\Api\V1\Auth\DeleteAccountResource;
use App\Http\Resources\Api\V1\Auth\LogoutResource;
use App\Http\Resources\Api\V1\Auth\RefreshTokenResource;
use App\Models\User;
use App\Services\Api\V1\Auth\AuthenticatedAuthService;
use App\Traits\Api\V1\ApiResponse;
use Exception;
use Illuminate\Http\JsonResponse;

class AuthenticatedAuthController extends Controller
{
    // Traits used for API response formatting
    use ApiResponse;

    // ! Constructor injection of AuthenticatedAuthService for handling authenticated user logic
    public function __construct(
        protected AuthenticatedAuthService $authService
    ) {}

    /**
     * Logout authenticated user.
     */
    public function logout(): JsonResponse
    {
        try {
            $result = $this->authService->logout();

            return $this->success(new LogoutResource($result), 'Successfully logged out.', 200);
        } catch (Exception $e) {
            return $this->error('Something went wrong: '.$e->getMessage(), 500);
        }
    }

    /**
     * Refresh JWT token.
     */
    public function refresh(): JsonResponse
    {
        try {
            $result = $this->authService->refresh();

            return $this->success(new RefreshTokenResource($result), 'Token refreshed successfully.', 200);
        } catch (Exception $e) {
            return $this->unauthorized('Failed to refresh token: '.$e->getMessage());
        }
    }

    /**
     * Change authenticated user password.
     */
    public function changePassword(ChangePasswordRequest $request): JsonResponse
    {
        try {
            /** @var User $user */
            $user = auth('api')->user();

            $result = $this->authService->changePassword(
                $user,
                $request->validated('current_password'),
                $request->validated('new_password')
            );

            return $this->success(new ChangePasswordResource($result), 'Password updated successfully.', 200);
        } catch (Exception $e) {
            return $this->error('Something went wrong: '.$e->getMessage(), 500);
        }
    }

    /**
     * Soft delete authenticated user account.
     */
    public function deleteAccount(DeleteAccountRequest $request): JsonResponse
    {
        try {
            /** @var User $user */
            $user = auth('api')->user();

            $result = $this->authService->deleteAccount($user, $request->validated('password'));

            return $this->success(new DeleteAccountResource($result), 'Your account has been deleted successfully.', 200);
        } catch (Exception $e) {
            return $this->error('Something went wrong: '.$e->getMessage(), 500);
        }
    }
}
