<?php

namespace App\Services\Api\V1\Auth;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;

class AuthenticatedAuthService
{
    /**
     * Logout current user.
     */
    public function logout(): void
    {
        auth('api')->logout();
    }

    /**
     * Refresh JWT Token.
     *
     * @return array<string, mixed>
     *
     * @throws Exception
     */
    public function refresh(): array
    {
        $newToken = auth('api')->refresh();
        /** @var User $user */
        $user = auth('api')->user();

        return $this->formatTokenResponse($newToken, $user);
    }

    /**
     * Change user password.
     *
     * @throws Exception
     */
    public function changePassword(User $user, string $currentPassword, string $newPassword): bool
    {
        if (! Hash::check($currentPassword, $user->password)) {
            throw new Exception('Your current password does not match our records.', 422);
        }

        $user->update([
            'password' => $newPassword,
        ]);

        return true;
    }

    /**
     * Delete user account.
     *
     * @throws Exception
     */
    public function deleteAccount(User $user, string $password): bool
    {
        if (! Hash::check($password, $user->password)) {
            throw new Exception('Invalid password confirmation.', 422);
        }

        auth('api')->logout();

        return $user->delete();
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
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
            'user' => $user,
        ];
    }
}
