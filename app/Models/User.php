<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Guarded([])]
#[Hidden(['password', 'remember_token', 'facebook_id', 'google_id', 'apple_id', 'deleted_at'])]
class User extends Authenticatable
{
    // The model's default values for attributes.
    use HasFactory, Notifiable, SoftDeletes;

    //table name
    protected $table = 'users';

    // The attributes that should be cast.
    protected function casts(): array
    {
        return [
            'id'                   => 'integer',
            'first_name'           => 'string',
            'last_name'            => 'string',
            'username'             => 'string',
            'phone'                => 'string',
            'birthday'             => 'date',
            'email'                => 'string',
            'avatar'               => 'string',
            'cover'                => 'string',
            'location'             => 'string',
            'role'                 => 'string',
            'bio'                  => 'string',
            'password'             => 'hashed',
            'email_verified_at'    => 'datetime',
            'terms_and_conditions' => 'boolean',
            'facebook_id'          => 'string',
            'google_id'            => 'string',
            'apple_id'             => 'string',
            'status'               => 'string',
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
