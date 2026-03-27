<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class LandingPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 0. Ensure Storage Directories & Placeholders
        $dirs = ['chargers', 'testimonials', 'blog-posts'];
        foreach ($dirs as $dir) {
            Storage::disk('public')->makeDirectory($dir);
        }

        // 1. Site Settings
        $settings = [
            ['key' => 'site_name', 'value' => 'AMTECH EV', 'group' => 'general'],
            ['key' => 'site_title', 'value' => 'AMTECH EV Specialist', 'group' => 'general'],
            ['key' => 'hero_title', 'value' => "Malaysia's <span class=\"text-ev-green\">Electric Vehicle</span><br>Charger Specialist", 'group' => 'hero'],
            ['key' => 'hero_subtitle', 'value' => 'AMTECH EV makes EV charging accessible in Malaysia with high-quality products and services for homes and businesses. Experience the future of mobility today.', 'group' => 'hero'],
            ['key' => 'hero_badge', 'value' => "Malaysia's #1 EV Solutions", 'group' => 'hero'],
            ['key' => 'contact_email', 'value' => 'hello@amtechev.com', 'group' => 'contact'],
            ['key' => 'contact_address', 'value' => 'No 1, Jalan AMTECH EV, 50000 Kuala Lumpur', 'group' => 'contact'],
            ['key' => 'whatsapp_number', 'value' => '601167686742', 'group' => 'contact'],
            ['key' => 'whatsapp_bubble_text', 'value' => 'Hi, I want to install an EV charger - AMTECH EV', 'group' => 'contact'],
            ['key' => 'footer_about', 'value' => "Leading the charge in Malaysia's EV revolution. Quality, reliability, and innovation in every connection.", 'group' => 'footer'],
            ['key' => 'footer_copyright', 'value' => '© 2026 AMTECH EV Malaysia. All rights reserved.', 'group' => 'footer'],
            ['key' => 'paypal_client_id', 'value' => '', 'group' => 'payment'],
            ['key' => 'paypal_secret', 'value' => '', 'group' => 'payment'],
            ['key' => 'paypal_mode', 'value' => 'sandbox', 'group' => 'payment'],
        ];

        foreach ($settings as $setting) {
            \App\Models\SiteSetting::updateOrCreate(['key' => $setting['key']], $setting);
        }

        // 2. Chargers
        $chargers = [
            [
                'name' => '11kw Home E1 EV Charger', 
                'price' => 'RM 2,499', 
                'image_url' => 'chargers/e1_11kw.png',
                'description' => '<h2>Premium Home Charging Solution</h2><p>The E1 11kW Home Charger is designed for efficiency and safety. Perfectly suited for Malaysian homes.</p><ul><li><strong>Fast Charging:</strong> Up to 11kW output.</li><li><strong>Safety:</strong> Built-in RCD Protection.</li><li><strong>Connectivity:</strong> Bluetooth and WiFi enabled.</li></ul>'
            ],
            [
                'name' => 'Teltonika 22kw Home EV Charger', 
                'price' => 'RM 4,200', 
                'image_url' => 'chargers/teltonika_22kw.png',
                'description' => '<h2>High-Power Smart Charging</h2><p>Teltonika brings industrial-grade reliability to your garage. Future-proof your EV experience.</p><ul><li><strong>Industrial Build:</strong> Durable and weatherproof.</li><li><strong>Smart App:</strong> Complete control via mobile app.</li><li><strong>Warranty:</strong> 2-year manufacturer warranty.</li></ul>'
            ],
            [
                'name' => '7kw Home E1 EV Charger', 
                'price' => 'RM 1,899', 
                'image_url' => 'chargers/e1_7kw.png',
                'description' => '<h2>Efficient Entry-Level Charger</h2><p>Great for daily commuters who want reliable charging without the complexity of ultra-high power units.</p><ul><li><strong>Compact:</strong> Minimalist design.</li><li><strong>Plug & Play:</strong> No complex setup needed.</li><li><strong>IP55:</strong> Fully waterproof.</li></ul>'
            ]
        ];

        foreach ($chargers as $charger) {
            \App\Models\Charger::updateOrCreate(['name' => $charger['name']], $charger);
        }

        // 3. Testimonials
        $testimonials = [
            [
                'author_name' => 'Happy Customer',
                'author_role' => 'Verified Owner',
                'author_image' => 'testimonials/user1.jpg',
                'content' => '<p>The installation was <strong>incredibly fast</strong> and the team was very professional. Highly recommend Amtech EV for home charging!</p>',
                'rating' => 5
            ],
            [
                'author_name' => 'Satisfied Client',
                'author_role' => 'EV Enthusiast',
                'author_image' => 'testimonials/user2.jpg',
                'content' => '<p>Top-notch service and the charger works perfectly with my Tesla. The <em>green glow</em> looks amazing in my garage!</p>',
                'rating' => 5
            ],
            [
                'author_name' => 'Business Owner',
                'author_role' => 'Commercial User',
                'author_image' => 'testimonials/user3.jpg',
                'content' => '<p>Great support and advice on choosing the right charger. The maintenance service is also very reliable.</p>',
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
                'image_url' => 'blog-posts/guide_2026.jpg',
                'content' => '<h2>Introduction</h2><p>Choosing an EV charger in 2026 is about more than just power; it is about smart integration and safety.</p><p>In this guide, we break down the top models available in Malaysia, including the E1 series and Teltonika industrial units.</p><blockquote>Quality over quantity: Always ensure your installation is performed by a ST-certified technician.</blockquote>',
                'category' => 'Guides',
                'published_at' => now(),
            ],
            [
                'title' => 'Malacca Emerges as Malaysia’s EV Manufacturing Hub',
                'slug' => 'malacca-ev-manufacturing-hub',
                'excerpt' => 'A deep dive into how Malacca is becoming a central player in the EV industry.',
                'image_url' => 'blog-posts/malacca_hub.jpg',
                'content' => '<h2>The Strategic Shift</h2><p>Malacca has recently announced new tax incentives for EV manufacturers, attracting billions in foreign investment.</p><p>This move positions Malaysia as a major competitor in the Southeast Asian green energy market.</p>',
                'category' => 'News',
                'published_at' => now(),
            ],
            [
                'title' => 'Analysis on EV Charger Components',
                'slug' => 'analysis-ev-charger-components',
                'excerpt' => 'Understanding the technical aspects that make a great EV charger.',
                'image_url' => 'blog-posts/technical_analysis.jpg',
                'content' => '<h2>What is inside your charger?</h2><p>From the PCB to the Type 2 cable, every component matters for heat dissipation and longevity.</p><p>We analyze why high-quality RCDs are non-negotiable for premium home charging setups.</p>',
                'category' => 'Technical',
                'published_at' => now(),
            ]
        ];

        foreach ($posts as $post) {
            \App\Models\BlogPost::updateOrCreate(['slug' => $post['slug']], $post);
        }
    }
}
