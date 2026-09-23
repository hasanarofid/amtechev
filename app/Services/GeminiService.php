<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GeminiService
{
    protected ?string $apiKey;
    protected array $models = [
        'gemini-3.5-flash',
        'gemini-3.5-flash-lite',
        'gemini-2.5-pro',
    ];

    public function __construct()
    {
        $this->apiKey = config('services.gemini.api_key') ?? env('GEMINI_API_KEY');
    }

    /**
     * Generate high-quality, long-form, authoritative SEO blog post for Amtech EV Malaysia.
     *
     * @param string $topic
     * @param string|null $category
     * @return array|null
     */
    public function generateContent(string $topic, ?string $category = 'EV Charging'): ?array
    {
        if (!$this->apiKey) {
            Log::error('GeminiService: GEMINI_API_KEY is not configured in .env / services.php');
            return null;
        }

        $systemPrompt = "You are an elite, senior EV (Electric Vehicle) technical writer and certified electrical engineer in Malaysia working for 'Amtech EV' (amtechev.com) — Malaysia's premier EV charger supply, consultation, and certified installation specialist.

Your mission is to produce a deeply authoritative, comprehensively detailed, high-value technical article (>1,200 - 1,800 words) that provides unmatched value to Malaysian EV drivers, homeowners, condominium committees (JMB/MC), and businesses.

The article MUST meet Google Helpful Content & Google AdSense High-Quality Guidelines (No thin content, no fluff, genuine technical depth, practical math/cost breakdowns, and actionable step-by-step guidance).

Key Malaysian Technical Context to Incorporate Naturally:
1. Regulatory & Safety Standards: Suruhanjaya Tenaga (ST) / Energy Commission guidelines for EVCS, MS IEC 61851 (EV conductive charging system), MS IEC 62196 (Type 2 / CCS2), Type B RCCB (Residual Current Circuit Breaker) or Type A + 6mA DC residual direct current detection, dedicated earthing (TT earthing rod < 10 ohms), and Jabatan Bomba dan Penyelamat Malaysia (JBPM) safety protocols.
2. TNB & Electricity: Tenaga Nasional Berhad (TNB) Domestic Tariff A vs Time-of-Use (ToU), single-phase (up to 32A/7.4kW) vs three-phase (up to 63A/11kW-22kW) supply upgrades, and peak vs off-peak cost calculations.
3. Government Incentives: LHDN Individual Income Tax Relief up to RM2,500 for EV charging equipment & installation expenses (valid until 2027), road tax exemptions, and green energy initiatives.
4. Ecosystem: ChargEV, Gentari, JomCharge, PLUS highway charging, solar PV + home wallbox synergy.
5. Tone: Authoritative, professional, trustworthy, practical, and highly engaging.

Output format MUST be strict JSON with the following schema:
{
  \"title\": \"Compelling, high-CTR, SEO-optimized title in English (60-75 chars)\",
  \"title_ms\": \"Tajuk artikel yang menarik & SEO-friendly dalam Bahasa Melayu\",
  \"category\": \"{$category}\",
  \"excerpt\": \"Crisp, persuasive meta description/excerpt in English (150-160 chars) highlighting the core value.\",
  \"excerpt_ms\": \"Ringkasan meta deskripsi yang padat & berinformasi dalam Bahasa Melayu (150-160 aksara).\",
  \"content\": \"Full long-form HTML article in English. Must include semantic <h2>, <h3>, <p>, <ul>, <ol>, <li>, <blockquote>, and at least ONE detailed HTML <table> with structured data/comparisons/costs. End with a comprehensive FAQ section containing 3-5 technical questions and answers.\",
  \"content_ms\": \"Artikel lengkap dalam Bahasa Melayu dengan struktur HTML yang sama (<h2>, <h3>, <p>, <ul>, <ol>, <li>, <blockquote>, <table>, dan seksyen Soalan Lazim FAQ). Pastikan laras bahasa Melayu yang profesional dan natural (bukan direct translation kaku).\"
}";

        $userPrompt = "Generate a comprehensive, high-authority master guide on the topic: '{$topic}'. Include detailed technical specifications, Malaysian regulations (TNB & Suruhanjaya Tenaga), clear cost calculations in Ringgit Malaysia (RM), safety guidelines, and step-by-step advice.";

        foreach ($this->models as $model) {
            try {
                $endpoint = "https://generativelanguage.googleapis.com/v1beta/models/{$model}:generateContent?key={$this->apiKey}";

                $response = Http::timeout(90)->post($endpoint, [
                    'contents' => [
                        [
                            'role' => 'user',
                            'parts' => [
                                ['text' => $systemPrompt . "\n\n" . $userPrompt]
                            ]
                        ]
                    ],
                    'generationConfig' => [
                        'response_mime_type' => 'application/json',
                        'temperature' => 0.7,
                    ]
                ]);

                if ($response->successful()) {
                    $json = $response->json();
                    $rawText = $json['candidates'][0]['content']['parts'][0]['text'] ?? null;

                    if ($rawText) {
                        // Strip markdown code block wrappers if any
                        $cleanJson = preg_replace('/^```(?:json)?\s*/i', '', trim($rawText));
                        $cleanJson = preg_replace('/\s*```$/', '', $cleanJson);

                        $decoded = json_decode($cleanJson, true);
                        if (is_array($decoded) && !empty($decoded['title']) && !empty($decoded['content'])) {
                            Log::info("GeminiService: Successfully generated article for topic '{$topic}' using model '{$model}'");
                            return $decoded;
                        }
                    }
                } else {
                    Log::warning("GeminiService: Model '{$model}' returned HTTP {$response->status()}: " . substr($response->body(), 0, 200));
                }
            } catch (\Exception $e) {
                Log::warning("GeminiService: Exception with model '{$model}': " . $e->getMessage());
            }
        }

        Log::error("GeminiService: Failed to generate content across all models for topic '{$topic}'");
        return null;
    }
}
