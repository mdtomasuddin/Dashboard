<?php

namespace App\Services\Api\V1\Auth;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Tymon\JWTAuth\Facades\JWTAuth;

class SocialiteService
{
    /**
     * Handle socialite authentication (Google, Facebook, Apple).
     *
     * @param  string  $provider
     * @param  string  $socialToken
     * @param  string  $role
     * @return array<string, mixed>
     *
     * @throws UnauthorizedHttpException|Exception
     */
    public function loginWithSocialite(string $provider, string $socialToken, string $role = 'user'): array
    {
        // check provider
        if (! in_array($provider, ['google', 'facebook', 'apple'])) {
            throw new UnauthorizedHttpException('', 'Provider not supported.');
        }

        // get social user
        try {
            $socialUser = Socialite::driver($provider)->stateless()->userFromToken($socialToken);
        } catch (Exception $e) {
            throw new UnauthorizedHttpException('', 'Invalid token or provider.');
        }
        // check social user data
        if (! $socialUser || ! $socialUser->getEmail()) {
            throw new UnauthorizedHttpException('', 'Invalid social user data or missing email.');
        }

        $email            = strtolower($socialUser->getEmail());
        $providerIdColumn = $provider . '_id';
        $socialId         = $socialUser->getId();

        // Use transaction for atomicity
        return DB::transaction(function () use ($socialUser, $email, $providerIdColumn, $socialId) {
            // Check if user exists by social id or email (soft deleted check included)
            $existingUser = User::withTrashed()->where(function ($query) use ($providerIdColumn, $socialId, $email) {
                if ($socialId) {
                    $query->where($providerIdColumn, $socialId);
                }
                $query->orWhere('email', $email);
            })->first();

            // check trashed user
            if ($existingUser && $existingUser->trashed()) {
                throw new UnauthorizedHttpException('', 'Your account has been deleted. Please contact support.');
            }

            $isNewUser = false;
            // If user exists, update avatar and social id if needed
            if ($existingUser) {
                $user    = $existingUser;
                $updates = [];
                if ($socialId && empty($user->{$providerIdColumn})) {
                    $updates[$providerIdColumn] = $socialId;
                }
                if (empty($user->avatar) && $socialUser->getAvatar()) {
                    $updates['avatar'] = $socialUser->getAvatar();
                }
                if (! empty($updates)) {
                    $user->update($updates);
                }
            } else {
                // create new user
                $fullName     = trim($socialUser->getName() ?? $socialUser->getNickname() ?? 'User');
                $nameParts    = explode(' ', $fullName, 2);
                $firstName    = $nameParts[0] ?? 'User';
                $lastName     = $nameParts[1] ?? '';
                //user create.
                $user = User::create([
                    'first_name'           => $firstName,
                    'last_name'            => $lastName,
                    'email'                => $email,
                    'password'             => bcrypt(Str::random(16)),
                    'email_verified_at'    => now(),
                    'terms_and_conditions' => true,
                    'role'                 => 'user',
                    'avatar'               => $socialUser->getAvatar(),
                    $providerIdColumn      => $socialId,
                    'status'               => 'active',
                ]);

                $isNewUser = true;
            }

            // check user status
            if ($user->status !== 'active') {
                throw new UnauthorizedHttpException('', 'Your account is ' . $user->status . '. Please contact support.');
            }
            // generate token JWTAuth
            $token = JWTAuth::fromUser($user);
            if (! $token) {
                throw new Exception('Could not generate authentication token.');
            }

            return [
                'access_token'         => $token,
                'token_type'           => 'bearer',
                'expires_in'           => JWTAuth::factory()->getTTL() * 60,
                'user'                 => $user,
                'was_recently_created' => $isNewUser,
            ];
        });
    }
}
