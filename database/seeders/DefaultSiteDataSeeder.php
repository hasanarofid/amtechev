<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DefaultSiteDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Site Settings
        $settings = [
            // Hero
            'hero_badge' => ['value' => 'BEST VALUE • EXPERT WORKMANSHIP', 'group' => 'hero'],
            'hero_title' => ['value' => "Malaysia's <span class=\"text-ev-green font-outline-2\">Electric Vehicle</span><br>Charger Specialist", 'group' => 'hero'],
            'hero_subtitle' => ['value' => 'Enjoy a hassle-free EV charger installation with a FREE site visit across Selangor & Kuala Lumpur.', 'group' => 'hero'],
            'hero_cta_main' => ['value' => 'WhatsApp Now', 'group' => 'hero'],
            'hero_image' => ['value' => 'technical_analysis.jpg', 'group' => 'hero'],
            
            // About
            'about_title' => ['value' => 'Why Choose Amtech EVC Specialist?', 'group' => 'about'],
            'about_content_1' => ['value' => 'At Amtech EVC Specialist, we provide the best value EV charger installation in Malaysia with a trusted and experienced team.', 'group' => 'about'],
            'about_content_2' => ['value' => 'We take pride in clean, precise workmanship — every installation is done with attention to detail, ensuring a neat and professional finish.', 'group' => 'about'],
            'about_highlight' => ['value' => 'Installation is just one part - We take care of the full process.', 'group' => 'about'],
            'about_image_1' => ['value' => 'galery/galeri1.jpeg', 'group' => 'about'],
            'about_image_2' => ['value' => 'galery/galeri2.jpeg', 'group' => 'about'],
            'about_image_3' => ['value' => 'galery/galeri3.jpeg', 'group' => 'about'],
            'about_image_4' => ['value' => 'galery/galeri4.jpeg', 'group' => 'about'],
            
            // Quality
            'quality_title' => ['value' => 'Built with Quality & Safety in Mind', 'group' => 'quality'],
            'quality_content' => ['value' => 'We use premium-grade components from trusted brands in Japan, France, and Switzerland — ensuring every installation is safe, reliable, and built to last.', 'group' => 'quality'],
            
            // Mission
            'mission_title' => ['value' => 'Supporting Malaysia’s EV Future', 'group' => 'mission'],
            'mission_content' => ['value' => 'Our mission is to make EV charging simple, safe, and accessible for everyone in Malaysia with fair, transparent pricing and no bullshit pricing.', 'group' => 'mission'],
            'mission_cta_text' => ['value' => 'Speak to an EV Charging Specialist — From a Free Site Visit and Consultation to Full Installation , We handle everything with expert workmanship and transparent pricing.', 'group' => 'mission'],
            'mission_image' => ['value' => 'galery/galeri5.jpeg', 'group' => 'mission'],
            
            // Contact
            'contact_address' => ['value' => 'No. 12, Jalan EV 1/1, Selangor, Malaysia', 'group' => 'contact'],
            'contact_email' => ['value' => 'info@amtechev.com', 'group' => 'contact'],
            'contact_phone' => ['value' => '+60 11-6768 6742', 'group' => 'contact'],
            'whatsapp_number' => ['value' => '601167686742', 'group' => 'contact'],
            'whatsapp_bubble_text' => ['value' => 'Hi, I want to install an EV charger', 'group' => 'contact'],

            // Footer
            'footer_about' => ['value' => 'Amtech EV Specialist is Malaysia\'s leading provider of comprehensive EV charging solutions, from home installation to commercial scale projects.', 'group' => 'footer'],
            'footer_copyright' => ['value' => '© 2024 AMTECH EV Specialist. All rights reserved.', 'group' => 'footer'],

            // Payment
            'payment_methods_text' => ['value' => 'We accept FPX, Credit Cards, and E-Wallets via secure payment gateways.', 'group' => 'payment'],

            // General
            'site_title' => ['value' => 'AMTECH EV Specialist', 'group' => 'general'],
            'site_logo' => ['value' => 'logo/amtech-removebg.png', 'group' => 'general'],

            // Services Section
            'services_badge' => ['value' => 'OUR EXPERTISE', 'group' => 'services'],
            'services_title' => ['value' => 'Expert EV Charging Specialist', 'group' => 'services'],
            'services_content' => ['value' => 'We provide comprehensive EV charging solutions tailored to your needs, ensuring a seamless experience from start to finish.', 'group' => 'services'],
            'services_image' => ['value' => 'premium_voltica_charger.jpg', 'group' => 'services'],
        ];

        foreach ($settings as $key => $data) {
            \App\Models\SiteSetting::firstOrCreate(['key' => $key], ['value' => $data['value'], 'group' => $data['group']]);
        }

        // Services
        $services = [
            ['title' => 'Supply & Install EV Charger (Best Wallbox Solutions)', 'icon' => 'heroicon-o-bolt'],
            ['title' => 'Residential Installation', 'icon' => 'heroicon-o-home'],
            ['title' => 'Commercial Installation', 'icon' => 'heroicon-o-building-office'],
            ['title' => 'EV Charger Repair', 'icon' => 'heroicon-o-wrench-screwdriver'],
            ['title' => 'Site Inspection & Consultation', 'icon' => 'heroicon-o-magnifying-glass'],
        ];

        foreach ($services as $index => $service) {
            \App\Models\Service::firstOrCreate(
                ['title' => $service['title']],
                ['icon' => $service['icon'], 'sort_order' => $index]
            );
        }

        // Quality Brands
        $qualityBrands = [
            ['brand' => 'Terasaki', 'desc' => 'Precision engineering and reliable electronics for safety.', 'logo' => 'brands/terasaki.png'],
            ['brand' => 'Schneider', 'desc' => 'Innovative electrical components and global safety standards.', 'logo' => 'brands/schneider.png'],
            ['brand' => 'ABB', 'desc' => 'High-performance connectivity and industrial-grade durability.', 'logo' => 'brands/abb.png'],
        ];

        foreach ($qualityBrands as $index => $qb) {
            \App\Models\QualityBrand::firstOrCreate(
                ['name' => $qb['brand']],
                ['description' => $qb['desc'], 'logo' => $qb['logo'], 'sort_order' => $index]
            );
        }

        // Gallery Items
        for ($i = 1; $i <= 11; $i++) {
            \App\Models\GalleryItem::firstOrCreate(
                ['image_path' => 'galery/galeri' . $i . '.jpeg'],
                ['title' => 'Installation #' . $i, 'sort_order' => $i]
            );
        }
    }
}
