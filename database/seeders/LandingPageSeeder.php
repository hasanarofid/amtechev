<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LandingPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Site Settings
        $settings = [
            ['key' => 'hero_title', 'value' => "Malaysia's <span class=\"text-ev-green\">Electric Vehicle</span><br>Charger Specialist", 'group' => 'hero'],
            ['key' => 'hero_subtitle', 'value' => 'Amtech EV makes EV charging accessible in Malaysia with high-quality products and services for homes and businesses. Experience the future of mobility today.', 'group' => 'hero'],
            ['key' => 'hero_badge', 'value' => "Malaysia's #1 EV Solutions", 'group' => 'hero'],
            ['key' => 'contact_email', 'value' => 'hello@amtechev.com', 'group' => 'contact'],
            ['key' => 'contact_address', 'value' => 'No 1, Jalan Amtech EV, 50000 Kuala Lumpur', 'group' => 'contact'],
            ['key' => 'footer_about', 'value' => "Leading the charge in Malaysia's EV revolution. Quality, reliability, and innovation in every connection.", 'group' => 'footer'],
            ['key' => 'footer_copyright', 'value' => '© 2026 Amtech EV Malaysia. All rights reserved.', 'group' => 'footer'],
        ];

        foreach ($settings as $setting) {
            \App\Models\SiteSetting::updateOrCreate(['key' => $setting['key']], $setting);
        }

        // 2. Chargers
        $chargers = [
            ['name' => '11kw Home E1 EV Charger', 'price' => 'RM 2,499', 'description' => 'Premium home charging solution.'],
            ['name' => 'Teltonika 22kw Home EV Charger', 'price' => 'RM 4,200', 'description' => 'High-power smart charger.'],
            ['name' => '7kw Home E1 EV Charger', 'price' => 'RM 1,899', 'description' => 'Efficient entry-level charger.']
        ];

        foreach ($chargers as $charger) {
            \App\Models\Charger::updateOrCreate(['name' => $charger['name']], $charger);
        }

        // 3. Testimonials
        $testimonials = [
            [
                'author_name' => 'Happy Customer',
                'author_role' => 'Verified Owner',
                'content' => 'The installation was incredibly fast and the team was very professional. Highly recommend Amtech EV for home charging!',
                'rating' => 5
            ],
            [
                'author_name' => 'Satisfied Client',
                'author_role' => 'EV Enthusiast',
                'content' => 'Top-notch service and the charger works perfectly with my Tesla. The green glow looks amazing in my garage!',
                'rating' => 5
            ],
            [
                'author_name' => 'Business Owner',
                'author_role' => 'Commercial User',
                'content' => 'Great support and advice on choosing the right charger. The maintenance service is also very reliable.',
                'rating' => 5
            ]
        ];

        foreach ($testimonials as $testimonial) {
            \App\Models\Testimonial::updateOrCreate(['content' => $testimonial['content']], $testimonial);
        }

        // 4. Blog Posts
        $posts = [
            [
                'title' => 'Best Home EV Charger Malaysia 2026 — Complete Buyer\'s Guide',
                'slug' => 'best-home-ev-charger-malaysia-2026',
                'excerpt' => 'Everything you need to know about choosing the right charger for your home.',
                'content' => 'Full content here...',
                'category' => 'Guides',
                'published_at' => now(),
            ],
            [
                'title' => 'Malacca Emerges as Malaysia’s EV Manufacturing Hub',
                'slug' => 'malacca-ev-manufacturing-hub',
                'excerpt' => 'A deep dive into how Malacca is becoming a central player in the EV industry.',
                'content' => 'Full content here...',
                'category' => 'News',
                'published_at' => now(),
            ],
            [
                'title' => 'Analysis on EV Charger Components',
                'slug' => 'analysis-ev-charger-components',
                'excerpt' => 'Understanding the technical aspects that make a great EV charger.',
                'content' => 'Full content here...',
                'category' => 'Technical',
                'published_at' => now(),
            ]
        ];

        foreach ($posts as $post) {
            \App\Models\BlogPost::updateOrCreate(['slug' => $post['slug']], $post);
        }
    }
}
