<?php

namespace App\Http\Resources\Api\V1\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LoginUserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'token_type'   => $this->resource['token_type'] ?? null,
            'access_token' => $this->resource['access_token'] ?? null,
            'expires_in'   => $this->resource['expires_in'] ?? null,
            'user'         => [
                'id'                   => $this->resource['user']->id ?? null,
                'first_name'           => $this->resource['user']->first_name ?? null,
                'last_name'            => $this->resource['user']->last_name ?? null,
                'username'             => $this->resource['user']->username ?? null,
                'email'                => $this->resource['user']->email ?? null,
                'role'                 => $this->resource['user']->role ?? null,
                'terms_and_conditions' => $this->resource['user']->terms_and_conditions ?? null,
            ],
        ];
    }
}
