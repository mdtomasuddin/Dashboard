<?php

namespace Database\Seeders;

use App\Models\FAQ;
use Illuminate\Database\Seeder;

class FAQSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faqs = [
            [
                'question'   => 'What services does your platform offer?',
                'answer'     => 'We provide end-to-end digital solutions, software development, and consultancy services.',
                'status'     => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question'   => 'How can I contact customer support?',
                'answer'     => 'You can reach out to our support team via email or through our official contact page.',
                'status'     => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question'   => 'What is the standard response time for queries?',
                'answer'     => 'Our support team typically responds to inquiries within 24 business hours.',
                'status'     => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($faqs as $faq) {
            FAQ::create($faq);
        }
    }
}

