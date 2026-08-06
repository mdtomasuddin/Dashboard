<?php

namespace App\Services\Api\V1\Auth;

use App\Models\OTP;
use App\Models\User;
use App\Notifications\Api\V1\Auth\SendOtpNotification;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AuthService
{
    /**
     * Register a new user.
     *
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     *
     * @throws Exception
     */
    public function register(array $data): array
    {
        return DB::transaction(function () use ($data) {
            $baseUsername = Str::slug($data['first_name'] . ' ' . $data['last_name']) ?: 'user';
            $username     = $baseUsername . '_' . Str::lower(Str::random(4));

            $user = User::create([
                'first_name'           => $data['first_name'],
                'last_name'            => $data['last_name'],
                'username'             => $username,
                'email'                => strtolower($data['email']),
                'password'             => $data['password'],
                'phone'                => $data['phone'] ?? null,
                'terms_and_conditions' => $data['terms_and_conditions'] ?? true,
                'role'                 => 'user',
                'status'               => 'active',
            ]);

            $token = auth('api')->login($user);

            if (! $token) {
                throw new Exception('Could not generate authentication token.');
            }

            // Automatically send OTP for verification upon registration
            $this->sendOtp($user->email);

            return $this->formatTokenResponse($token, $user);
        });
    }

    /**
     * Authenticate user credentials and return JWT token.
     *
     * @param  array{email: string, password: string}  $credentials
     * @return array<string, mixed>
     *
     * @throws Exception
     */
    public function login(array $credentials): array
    {
        $token = auth('api')->attempt([
            'email'    => strtolower($credentials['email']),
            'password' => $credentials['password'],
        ]);

        if (! $token) {
            throw new Exception('Invalid email or password credentials.', 401);
        }

        /** @var User $user */
        $user = auth('api')->user();

        if ($user->status !== 'active') {
            auth('api')->logout();
            throw new Exception('Your account is ' . $user->status . '. Please contact support.', 403);
        }

        return $this->formatTokenResponse($token, $user);
    }

    /**
     * Send OTP for password recovery or account verification.
     *
     *
     * @throws Exception
     */
    public function sendOtp(string $email, string $type = 'email'): OTP
    {
        $user = User::where('email', strtolower($email))->first();

        if (! $user) {
            throw new Exception('User not found with the provided email address.', 404);
        }

        // Deactivate previous active OTPs for this user
        OTP::where('user_id', $user->id)->where('status', true)->update(['status' => false]);

        // Generate 6-digit numeric OTP
        $otpCode = (string) random_int(100000, 999999);

        /** @var OTP $otp */
        $otp = OTP::create([
            'user_id'         => $user->id,
            'type'            => $type,
            'otp'             => $otpCode,
            'is_otp_verified' => false,
            'otp_expires_at'  => now()->addMinutes(10),
            'status'          => true,
        ]);

        // Send OTP notification email
        $user->notify(new SendOtpNotification($otpCode, 10));

        return $otp;
    }

    /**
     * Verify matching OTP code.
     *
     *
     * @throws Exception
     */
    public function verifyOtp(string $email, string $otpCode): bool
    {
        $user = User::where('email', strtolower($email))->first();

        if (! $user) {
            throw new Exception('User not found with the provided email address.', 404);
        }

        $otpRecord = OTP::where('user_id', $user->id)->where('otp', $otpCode)->where('status', true)
            ->where('is_otp_verified', false)->where('otp_expires_at', '>', now())->first();

        if (! $otpRecord) {
            throw new Exception('Invalid or expired OTP code.', 422);
        }

        $otpRecord->update([
            'is_otp_verified' => true,
            'otp_verified_at' => now(),
        ]);

        if (is_null($user->email_verified_at)) {
            $user->update(['email_verified_at' => now()]);
        }

        return true;
    }

    /**
     * Reset user password using verified OTP.
     *
     * @param  array{email: string, otp: string, password: string}  $data
     *
     * @throws Exception
     */
    public function resetPassword(array $data): bool
    {
        return DB::transaction(function () use ($data) {
            $user = User::where('email', strtolower($data['email']))->first();

            if (! $user) {
                throw new Exception('User not found with the provided email address.', 404);
            }

            // Check if OTP is verified or matches
            $otpRecord = OTP::where('user_id', $user->id)->where('otp', $data['otp'])->where('status', true)->first();

            if (! $otpRecord) {
                throw new Exception('Invalid OTP code provided.', 422);
            }

            if ($otpRecord->otp_expires_at < now()) {
                throw new Exception('The provided OTP has expired.', 422);
            }

            if (! $otpRecord->is_otp_verified) {
                throw new Exception('The provided OTP has not been verified.', 422);
            }

            // Update user password
            $user->update([
                'password' => $data['password'],
            ]);

            // Invalidate OTP record
            $otpRecord->update([
                'is_otp_verified' => true,
                'otp_verified_at' => now(),
                'status'          => false,
            ]);

            return true;
        });
    }

    /**
     * Format JWT token response array.
     *
     * @return array<string, mixed>
     */
    protected function formatTokenResponse(string $token, User $user): array
    {
        return [
            'access_token' => $token,
            'token_type'   => 'bearer',
            'expires_in'   => auth('api')->factory()->getTTL() * 60,
            'user'         => $user,
        ];
    }
}
