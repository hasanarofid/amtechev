<?php

namespace App\Console\Commands;

use App\Models\BlogPost;
use App\Services\GeminiService;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class GenerateContentCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'blog:generate-content 
                            {--topic= : Specific topic to write about}
                            {--count=1 : Number of articles to generate}
                            {--category=EV Charging : Category for the articles}
                            {--days-interval=3 : Days gap between scheduled publication dates}
                            {--start-date= : Start date for publication schedule (Y-m-d), defaults to now}
                            {--auto : Automatically pick next available topics from curated pool}
                            {--dry-run : Simulate generation without saving to database}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate authoritative, SEO-rich, long-form blog articles using Gemini AI and schedule them to satisfy Google AdSense & boost organic search traffic.';

    /**
     * Curated Malaysian EV keyword & high-intent topic pool.
     *
     * @var array
     */
    protected array $curatedTopics = [
        [
            'topic' => 'Complete EV Home Charger Installation Guide in Malaysia: 7.4kW vs 11kW vs 22kW, TNB Requirements, and Suruhanjaya Tenaga Guidelines',
            'category' => 'Installation Guide',
        ],
        [
            'topic' => 'Cara Pasang EV Charger di Kondominium & Apartment Malaysia: Panduan Lengkap Kelulusan JMB / MC dan Kos Terlibat',
            'category' => 'Condo & Strata',
        ],
        [
            'topic' => 'TNB Electricity Tariffs for EV Charging: How to Save Up to 50% with Time-of-Use (ToU) and Off-Peak Charging in Malaysia',
            'category' => 'Cost & Savings',
        ],
        [
            'topic' => 'Panduan Pelepasan Cukai Pendapatan LHDN RM2,500 untuk Pembelian dan Pemasangan Pengecas EV di Malaysia (Lanjutan Hingga 2027)',
            'category' => 'Government Incentives',
        ],
        [
            'topic' => 'Suruhanjaya Tenaga (ST) & Bomba Fire Safety Guidelines for EV Charging Systems (EVCS) in Residential and Commercial Buildings',
            'category' => 'Safety & Regulations',
        ],
        [
            'topic' => 'Solar PV and EV Charger Integration in Malaysia: How to Charge Your Electric Vehicle for Free Using Solar Energy',
            'category' => 'Green Energy',
        ],
        [
            'topic' => 'EV Battery Health and Lifespan in Malaysia: Best Charging Habits for Hot Tropical Weather (The 20%-80% Rule Explained)',
            'category' => 'Battery Maintenance',
        ],
        [
            'topic' => 'AC Slow Charging vs DC Fast Charging: Differences, Efficiency, and Long-Term Impact on EV Battery Degradation',
            'category' => 'Technical Guide',
        ],
        [
            'topic' => 'Panduan Lengkap Naik Taraf Bekalan TNB dari 1-Fasa (Single Phase) ke 3-Fasa (Three Phase) untuk Pengecas Wallbox 11kW dan 22kW',
            'category' => 'Electrical Guide',
        ],
        [
            'topic' => 'EV Charging Plugs and Standards in Malaysia: Type 2, CCS2, CHAdeMO, and Adapters Guide',
            'category' => 'Technical Guide',
        ],
        [
            'topic' => 'Long-Distance EV Road Trips in Malaysia: Route Planning, Highway Chargers (PLUS & LPT), and Must-Have EV Charging Apps',
            'category' => 'Lifestyle & Travel',
        ],
        [
            'topic' => 'EV Insurance in Malaysia: Battery Pack Coverage, Wallbox Protection, and Public Charging Liability',
            'category' => 'Insurance & Protection',
        ],
        [
            'topic' => 'Smart EV Chargers with Dynamic Load Balancing (DLB): Preventing Main Circuit Breaker Trips at Home',
            'category' => 'Smart Charging',
        ],
        [
            'topic' => 'Mitos dan Fakta: Adakah Selamat Mengecas dan Memandu Kereta EV Waktu Hujan Lebat dan Kilat di Malaysia?',
            'category' => 'Safety & Facts',
        ],
        [
            'topic' => 'Portable 3-Pin EV Chargers vs Dedicated Wallbox: Why You Should Never Rely on Standard Home Sockets for Daily EV Charging',
            'category' => 'Safety & Installation',
        ],
        [
            'topic' => 'Commercial EV Charging Solutions for Malaysian Businesses, Hotels, and Retail Malls: Revenue Models & ROI',
            'category' => 'Commercial EV',
        ],
        [
            'topic' => 'Troubleshooting Home EV Charging Issues: Common Error Codes, Red Light Indicators, and Solutions',
            'category' => 'Troubleshooting',
        ],
        [
            'topic' => 'Residual Current Device (RCD) Type B and 6mA DC Leakage Protection: Why It Is Mandatory for EV Chargers in Malaysia',
            'category' => 'Safety & Regulations',
        ],
        [
            'topic' => 'Cost Comparison: Electric Vehicle vs Petrol Car (RON95 & RON97) Total Cost of Ownership in Malaysia (2026 Edition)',
            'category' => 'Cost & Savings',
        ],
        [
            'topic' => 'Fleet Electrification in Malaysia: How Companies Can Transition to Commercial Electric Vans and Logistics Fleets',
            'category' => 'Fleet Solutions',
        ],
    ];

    /**
     * Available image assets.
     *
     * @var array
     */
    protected array $blogAssets = [
        'blog-assets/blog1-04052026.png',
        'blog-assets/blog2-04052026.png',
        'blog-assets/blog3-04052026.png',
        'blog-assets/blog4-05052026.jpg',
        'blog-assets/blog5-05052026.jpg',
        'blog-assets/blog6-06052026.png',
        'blog-assets/blog7-06052026.png',
        'blog-assets/blog8-07052026.png',
        'blog-assets/blog9-07052026.png',
        'blog-assets/blog10-08052026.png',
        'blog-assets/blog11-08052026.png',
        'blog-assets/blog12-08052026.jpg',
        'blog-assets/blog13-12052026.png',
        'blog-assets/blog14-12052026.png',
        'blog-assets/blog15-12052026.png',
        'blog-assets/blog16-15052026.png',
        'blog-assets/blog17-15052026.png',
        'blog-assets/blog18-15052026.png',
        'blog-assets/blog19-17052026.png',
        'blog-assets/blog20-17052026.png',
        'blog-assets/blog21-17052026.png',
        'blog-assets/blog22-24052026.png',
        'blog-assets/blog23-24052026.png',
        'blog-assets/blog24-24052026.png',
    ];

    /**
     * Execute the console command.
     */
    public function handle(GeminiService $gemini): int
    {
        $this->info('🚀 Starting Amtech EV High-Quality Content Generator...');

        $specificTopic = $this->option('topic');
        $count = (int) $this->option('count');
        $categoryOption = $this->option('category') ?: 'EV Charging';
        $daysInterval = (int) $this->option('days-interval') ?: 3;
        $startDateStr = $this->option('start-date');
        $isDryRun = $this->option('dry-run');

        $currentScheduleDate = $startDateStr ? Carbon::parse($startDateStr) : Carbon::now();

        $topicsToProcess = [];

        if ($specificTopic) {
            $topicsToProcess[] = [
                'topic' => $specificTopic,
                'category' => $categoryOption,
            ];
        } else {
            $existingTitles = [];
            try {
                $existingTitles = BlogPost::pluck('title')->toArray();
            } catch (\Exception $e) {
                $this->warn('Database connection note: ' . $e->getMessage());
            }

            foreach ($this->curatedTopics as $item) {
                $alreadyExists = false;
                foreach ($existingTitles as $existingTitle) {
                    if (similar_text(strtolower($item['topic']), strtolower($existingTitle)) > 70) {
                        $alreadyExists = true;
                        break;
                    }
                }

                if (!$alreadyExists) {
                    $topicsToProcess[] = $item;
                    if (count($topicsToProcess) >= $count) {
                        break;
                    }
                }
            }

            if (empty($topicsToProcess)) {
                $this->warn('All curated topics already exist in database. Generating with randomized technical focus...');
                $topicsToProcess[] = [
                    'topic' => 'Advanced EV Charging Best Practices & Energy Efficiency Guide for Malaysian EV Owners ' . date('Y'),
                    'category' => 'EV Charging',
                ];
            }
        }

        $generatedCount = 0;
        $totalBlogAssets = count($this->blogAssets);
        $totalExistingPosts = 0;
        try {
            $totalExistingPosts = BlogPost::count();
        } catch (\Exception $e) {
            // fallback
        }

        foreach ($topicsToProcess as $index => $item) {
            $topic = $item['topic'];
            $category = $item['category'] ?? $categoryOption;

            $this->line('');
            $this->info("📝 Generating article [" . ($index + 1) . "/" . count($topicsToProcess) . "]: {$topic}");

            $articleData = $gemini->generateContent($topic, $category);

            if (!$articleData || empty($articleData['title']) || empty($articleData['content'])) {
                $this->error("❌ Failed to generate content for: {$topic}");
                continue;
            }

            // Generate unique slug
            $baseSlug = Str::slug($articleData['title']);
            $slug = $baseSlug;
            $slugCounter = 1;
            try {
                while (BlogPost::where('slug', $slug)->exists()) {
                    $slug = $baseSlug . '-' . $slugCounter;
                    $slugCounter++;
                }
            } catch (\Exception $e) {
                // If DB check is unavailable in local dry-run
            }

            // Assign a relevant image asset
            $imageIndex = ($totalExistingPosts + $index) % $totalBlogAssets;
            $selectedImage = $this->blogAssets[$imageIndex];

            $publishDate = $currentScheduleDate->copy()->addDays($index * $daysInterval);

            if ($isDryRun) {
                $this->comment("🔍 [DRY RUN] Title: " . $articleData['title']);
                $this->comment("           Title (MS): " . ($articleData['title_ms'] ?? 'N/A'));
                $this->comment("           Slug: " . $slug);
                $this->comment("           Publish Date: " . $publishDate->toDateTimeString());
                $this->comment("           Image: " . $selectedImage);
                $this->comment("           Content Length: " . strlen($articleData['content']) . " chars (EN) / " . strlen($articleData['content_ms'] ?? '') . " chars (MS)");
                $this->info("✨ [DRY RUN PREVIEW OK]");
                $generatedCount++;
            } else {
                BlogPost::create([
                    'title' => $articleData['title'],
                    'title_ms' => $articleData['title_ms'] ?? null,
                    'slug' => $slug,
                    'excerpt' => $articleData['excerpt'] ?? null,
                    'excerpt_ms' => $articleData['excerpt_ms'] ?? null,
                    'content' => $articleData['content'],
                    'content_ms' => $articleData['content_ms'] ?? null,
                    'image_url' => $selectedImage,
                    'category' => $articleData['category'] ?? $category,
                    'author_name' => 'Amtech Technical Team',
                    'published_at' => $publishDate,
                ]);

                $this->info("✅ Successfully saved: \"{$articleData['title']}\" (Scheduled for: {$publishDate->format('d M Y')})");
                $generatedCount++;
            }

            // Short pause to avoid API rate limits
            if ($index < count($topicsToProcess) - 1) {
                sleep(2);
            }
        }

        $this->line('');
        $this->info("🎉 Completed! Total generated articles: {$generatedCount}");

        return Command::SUCCESS;
    }
}
