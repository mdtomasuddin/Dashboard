<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OTP extends Model
{
    // The attributes that are mass assignable.
    protected $guarded = [];

    // The attributes that should be hidden for serialization.
    protected $hidden = ['created_at', 'updated_at'];

    // The attributes that should be cast.
    protected function casts(): array
    {
        return [
            'id'              => 'integer',
            'type'            => 'string',
            'otp'             => 'string',
            'is_otp_verified' => 'boolean',
            'otp_expires_at'  => 'datetime',
            'otp_verified_at' => 'datetime',
            'status'          => 'boolean',
            'created_at'      => 'datetime',
            'updated_at'      => 'datetime',
        ];
    }

    // Relationships and other model methods can be added here
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
