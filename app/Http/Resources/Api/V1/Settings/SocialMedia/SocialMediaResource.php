<?php

namespace App\Http\Resources\Api\V1\Settings\SocialMedia;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SocialMediaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'           => $this->id,
            'social_media' => $this->social_media,
            'profile_link' => $this->profile_link,
        ];
    }
}
