<?php

namespace App\Services\Web\V1\User;

use App\Helpers\Helper;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class UserService
{
    /**
     * Create a new user.
     */
    public function create(array $data): Model | Builder
    {
        // Auto-generate username from first name + last name
        $userData = [
            'first_name' => $data['first_name'],
            'last_name'  => $data['last_name'] ?? null,
            'username'   => $this->generateUsername($data['first_name'], $data['last_name'] ?? ''),
            'email'      => $data['email'],
            'phone'      => $data['phone'] ?? null,
            'password'   => bcrypt($data['password']),
            'role'       => $data['role'] ?? 'user',
            'status'     => $data['status'] ?? 'active',
            'bio'        => $data['bio'] ?? null,
            'location'   => $data['location'] ?? null,
            'birthday'   => $data['birthday'] ?? null,
        ];

        // Handle avatar
        if (isset($data['avatar']) && $data['avatar']) {
            $userData['avatar'] = Helper::uploadFile($data['avatar'], 'avatar');
        }

        // Handle cover photo
        if (isset($data['cover']) && $data['cover']) {
            $userData['cover'] = Helper::uploadFile($data['cover'], 'cover_photo');
        }

        return User::query()->create($userData);
    }

    /**
     * Update an existing user.
     */
    public function update(int $id, array $data): Model | Collection | Builder | array | null
    {
        $user = User::query()->findOrFail($id);

        $userData = [
            'first_name' => $data['first_name'],
            'last_name'  => $data['last_name'] ?? $user->last_name,
            'email'      => $data['email'],
            'phone'      => $data['phone'] ?? $user->phone,
            'role'       => $data['role'] ?? $user->role,
            'status'     => $data['status'] ?? $user->status,
            'bio'        => $data['bio'] ?? $user->bio,
            'location'   => $data['location'] ?? $user->location,
            'birthday'   => $data['birthday'] ?? $user->birthday?->format('Y-m-d'),
        ];

        // Only update username if first_name or last_name changed
        if (($data['first_name'] !== $user->first_name || ($data['last_name'] ?? $user->last_name) !== $user->last_name)) {
            $userData['username'] = $this->generateUsername($data['first_name'], $data['last_name'] ?? '');
        }

        // Update password if provided
        if (! empty($data['password'])) {
            $userData['password'] = bcrypt($data['password']);
        }

        // Handle avatar
        if (isset($data['avatar']) && $data['avatar']) {
            if ($user->avatar) {
                Helper::deleteFile($user->avatar);
            }
            $userData['avatar'] = Helper::uploadFile($data['avatar'], 'avatar');
        }

        // Handle cover photo
        if (isset($data['cover']) && $data['cover']) {
            if ($user->cover) {
                Helper::deleteFile($user->cover);
            }
            $userData['cover'] = Helper::uploadFile($data['cover'], 'cover_photo');
        }

        $user->update($userData);

        return $user->fresh();
    }

    /**
     * Generate a unique username from first_name + last_name.
     */
    private function generateUsername(string $firstName, string $lastName): string
    {
        $base     = Str::slug($firstName . ($lastName ? '-' . $lastName : ''));
        $username = $base;
        $counter  = 1;

        while (User::query()->where('username', $username)->exists()) {
            $username = $base . '-' . $counter;
            $counter++;
        }

        return $username;
    }
}
