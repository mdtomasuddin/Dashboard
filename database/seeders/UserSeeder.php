<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'first_name'           => 'Admin',
            'last_name'            => 'User',
            'email'                => 'admin@tabassum.com',
            'email_verified_at'    => now(),
            'password'             => bcrypt('password'),
            'phone'                => '01700000000',
            'role'                 => 'admin',
            'status'               => 'active',
            'terms_and_conditions' => true,
            'remember_token'       => Str::random(10),
        ]);

        User::create([
            'first_name'           => 'Test',
            'last_name'            => 'User',
            'email'                => 'test@tabassum.com',
            'email_verified_at'    => now(),
            'password'             => bcrypt('password'),
            'phone'                => '01700000001',
            'role'                 => 'user',
            'status'               => 'active',
            'terms_and_conditions' => true,
            'remember_token'       => Str::random(10),
        ]);
    }
}
