<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

#[Guarded([])]
#[Hidden(['password', 'remember_token', 'facebook_id', 'google_id', 'apple_id', 'deleted_at'])]
class User extends Authenticatable implements JWTSubject
{
    // The model's default values for attributes.
    use HasFactory, Notifiable, SoftDeletes;

    // table name
    protected $table = 'users';

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     */
    public function getJWTIdentifier(): mixed
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array<string, mixed>
     */
    public function getJWTCustomClaims(): array
    {
        return [
            'email' => $this->email,
            'role' => $this->role,
        ];
    }

    // The attributes that should be cast.
    protected function casts(): array
    {
        return [
            'id' => 'integer',
            'first_name' => 'string',
            'last_name' => 'string',
            'username' => 'string',
            'phone' => 'string',
            'birthday' => 'date',
            'email' => 'string',
            'avatar' => 'string',
            'cover' => 'string',
            'location' => 'string',
            'role' => 'string',
            'bio' => 'string',
            'password' => 'hashed',
            'email_verified_at' => 'datetime',
            'terms_and_conditions' => 'boolean',
            'facebook_id' => 'string',
            'google_id' => 'string',
            'apple_id' => 'string',
            'status' => 'string',
            'remember_token' => 'string',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
            'deleted_at' => 'datetime',
        ];
    }

    // Relationships
    public function otps()
    {
        return $this->hasMany(OTP::class);
    }
}
