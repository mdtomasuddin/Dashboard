<?php

namespace App\Models;

use Illuminate\Console\Attributes\Hidden;
use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Model;

#[Guarded([])]
#[Hidden(['created_at'])]
class SystemSetting extends Model
{
    // table name
    protected $table = 'system_settings';

    // The attributes that should be cast.
    protected function casts(): array
    {
        return [
            'id'                  => 'integer',
            'title'               => 'string',
            'system_name'         => 'string',
            'email'               => 'string',
            'phone'               => 'string',
            'address'             => 'string',
            'copyright_text'      => 'string',
            'description'         => 'string',
            'logo'                => 'string',
            'favicon'             => 'string',
            'timezone'            => 'string',
            'maintenance_mode'    => 'boolean',
            'maintenance_message' => 'string',
            'created_at'          => 'datetime',
            'updated_at'          => 'datetime',
        ];
    }

    // Accessor for the logo attribute
    public function getLogoAttribute(?string $url): ?string
    {
        if ($url) {
            if (strpos($url, 'http://') === 0 || strpos($url, 'https://') === 0) {
                return $url;
            } else {
                return asset('/' . $url);
            }
        }
        return null;
    }

    // Accessor for the favicon attribute
    public function getFaviconAttribute(?string $url): ?string
    {
        if ($url) {
            if (strpos($url, 'http://') === 0 || strpos($url, 'https://') === 0) {
                return $url;
            } else {
                return asset('/' . $url);
            }
        }
        return null;
    }
}
