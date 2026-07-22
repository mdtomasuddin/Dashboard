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
        //  Define user data for seeding
        $userData = [
            [
                'first_name'           => 'Admin',
                'last_name'            => 'User',
                'email'                => 'admin@gmail.com',
                'email_verified_at'    => now(),
                'password'             => bcrypt('12345678'),
                'phone'                => '01700000000',
                'role'                 => 'admin',
                'status'               => 'active',
                'terms_and_conditions' => true,
                'remember_token'       => Str::random(10),
            ],
            [
                'first_name'           => 'Tomas',
                'last_name'            => 'Uddin',
                'email'                => 'user@gmail.com',
                'email_verified_at'    => now(),
                'password'             => bcrypt('12345678'),
                'phone'                => '01700000001',
                'role'                 => 'user',
                'status'               => 'active',
                'terms_and_conditions' => true,
                'remember_token'       => Str::random(10),
            ],
            [
                'first_name'           => 'John',
                'last_name'            => 'Doe',
                'email'                => 'user2@gmail.com',
                'email_verified_at'    => now(),
                'password'             => bcrypt('12345678'),
                'phone'                => '01700000002',
                'role'                 => 'user',
                'status'               => 'active',
                'terms_and_conditions' => true,
                'remember_token'       => Str::random(10),
            ],

        ];

        // user data array loop to create users
        foreach ($userData as $data) {
            User::create($data);
        }
    }
}
