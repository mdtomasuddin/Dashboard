<?php
namespace Database\Seeders;

use App\Models\SocialMedia;
use Illuminate\Database\Seeder;

class SocialMediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id'           => 2,
                'social_media' => 'instagram',
                'profile_link' => 'https://www.instagram.com/',
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'id'           => 3,
                'social_media' => 'linkedin',
                'profile_link' => 'https://www.linkedin.com/',
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'id'           => 4,
                'social_media' => 'whatsapp',
                'profile_link' => 'https://www.whatsapp.com/',
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'id'           => 5,
                'social_media' => 'telegram',
                'profile_link' => 'https://telegram.org/',
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
        ];

        // Insert the data into the database
        foreach ($data as $newData) {
            SocialMedia::create($newData);
        }
    }
}
