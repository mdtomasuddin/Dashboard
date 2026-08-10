<?php

namespace App\Http\Resources\Api\V1\Settings\SystemSetting;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SystemSettingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'                  => $this->id,
            'title'               => $this->title,
            'system_name'         => $this->system_name,
            'email'               => $this->email,
            'phone'               => $this->phone,
            'address'             => $this->address,
            'copyright_text'      => $this->copyright_text,
            'description'         => $this->description,
            'logo'                => $this->logo,
            'favicon'             => $this->favicon,
            'timezone'            => $this->timezone,
            'maintenance_mode'    => (bool) $this->maintenance_mode,
            'maintenance_message' => $this->maintenance_message,
            'created_at'          => $this->created_at,
            'updated_at'          => $this->updated_at
        ];
    }
}
