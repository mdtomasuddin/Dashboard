<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Guarded([])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    // The model's default values for attributes.
    use HasFactory, Notifiable;

    //table name
    protected $table = 'users';

    // The attributes that should be cast.
    protected function casts(): array
    {
        return [
            'id'                   => 'integer',
            'email_verified_at'    => 'datetime',
            'password'             => 'hashed',
            'phone'                => 'string',
            'first_name'           => 'string',
            'last_name'            => 'string',
            'avatar'               => 'string',
            'cover_photo'          => 'string',
            'role'                 => 'string',
            'linkedin_url'         => 'string',
            'bio'                  => 'string',
            'terms_and_conditions' => 'boolean',
            'status'               => 'string',
            'calendar'             => 'string',
            'remember_token'       => 'string',
            'created_at'           => 'datetime',
            'updated_at'           => 'datetime',
            'deleted_at'           => 'datetime',
        ];
    }

    // Relationships
    public function otps()
    {
        return $this->hasMany(OTP::class);
    }
}
