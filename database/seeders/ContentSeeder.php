<?php

namespace Database\Seeders;

use App\Models\Content;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define the data
        $Data = [
            //terms and conditions
            [
                'id'         => 1,
                'type'       => 'termsAndConditions',
                'title'      => 'Terms & Conditions',
                'slug'       => 'terms-conditions',
                'content'    => "<p><br><strong>1. Acceptance</strong><br>By using PROLYNK you agree to these terms.</p><p><br><strong>2. Your account</strong><br>You are responsible for keeping your account secure.</p><p><br><strong>3. Acceptable use</strong><br>Do not use PROLYNK for spam or illegal activity.</p><p><br><strong>4. Intellectual property</strong><br>PROLYNK owns the platform. You own your data.</p><p><br><strong>5. Termination</strong><br>We may suspend accounts that violate these terms.</p><p><br><strong>6. Contact</strong><br>legal@prolynk.com</p>",
                'status'     => 'active',
                'created_at' => '2025-01-11 23:37:30',
                'updated_at' => '2025-01-12 23:40:33',
            ],
            //privacy policy
            [
                'id'         => 2,
                'type'       => 'privacyPolicy',
                'title'      => 'Privacy Policy',
                'slug'       => 'privacy-policy',
                'content'    => "<p><br><strong>1. Data we collect</strong><br>Your name, email, phone, profile photo, and links you provide.</p><p><br><strong>2. How we use it</strong><br>To display your public profile when someone taps your NFC card.</p><p><br><strong>3. Data storage</strong><br>Stored securely on our servers (PostgreSQL + AWS S3).</p><p><br><strong>4. Your rights</strong><br>You can edit or delete your data anytime from Settings.</p><p><br><strong>5. Contact</strong><br>support@prolynk.com</p>",
                'status'     => 'active',
                'created_at' => '2025-01-14 23:37:30',
                'updated_at' => '2025-01-15 23:40:33',
            ],
        ];

        // Insert the data
        foreach ($Data as $dataStore) {
            Content::create($dataStore);
        }
    }
}
