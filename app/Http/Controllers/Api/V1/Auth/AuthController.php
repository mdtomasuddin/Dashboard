<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Auth\LoginRequest;
use App\Http\Requests\Api\V1\Auth\RegisterRequest;
use App\Http\Requests\Api\V1\Auth\ResetPasswordRequest;
use App\Http\Requests\Api\V1\Auth\SendOtpRequest;
use App\Http\Requests\Api\V1\Auth\VerifyOtpRequest;
use App\Services\Api\V1\Auth\AuthService;
use App\Traits\Api\V1\ApiResponse;
use Exception;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    // Traits used for API response formatting
    use ApiResponse;

    // ! Constructor injection of AuthService for handling authentication logic
    public function __construct(
        protected AuthService $authService
    ) {}

    /**
     * Register a new user account.
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        try {
            $result = $this->authService->register($request->validated());

            return $this->success($result, 'User registered successfully. An OTP has been sent to your email.', 201);
        } catch (Exception $e) {
            return $this->error('Something went wrong: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Authenticate user credentials and return JWT token.
     */
    public function login(LoginRequest $request): JsonResponse
    {
        try {
            $result = $this->authService->login($request->validated());

            return $this->success($result, 'Login successful.', 200);
        } catch (Exception $e) {
            return $this->error('Something went wrong: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Send OTP for verification or password recovery.
     */
    public function sendOtp(SendOtpRequest $request): JsonResponse
    {
        try {
            $email = $request->validated('email');
            $type  = $request->validated('type', 'email');

            $this->authService->sendOtp($email, $type);

            return $this->success([], 'OTP verification code sent successfully to your email.', 200);
        } catch (Exception $e) {
            return $this->error('Something went wrong: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Verify matched OTP code.
     */
    public function verifyOtp(VerifyOtpRequest $request): JsonResponse
    {
        try {
            $email = $request->validated('email');
            $otp   = $request->validated('otp');

            $this->authService->verifyOtp($email, $otp);

            return $this->success([], 'OTP verified successfully.', 200);
        } catch (Exception $e) {
            return $this->error('Something went wrong: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Reset user password using verified OTP.
     */
    public function resetPassword(ResetPasswordRequest $request): JsonResponse
    {
        try {
            $this->authService->resetPassword($request->validated());

            return $this->success([], 'Password reset successfully. You can now log in with your new password.', 200);
        } catch (Exception $e) {
            return $this->error('Something went wrong: ' . $e->getMessage(), 500);
        }
    }
}
