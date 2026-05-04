<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GeminiService
{
    protected $apiKey;
    protected $apiUrl = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-flash-latest:generateContent';

    public function __construct()
    {
        $this->apiKey = config('services.gemini.api_key');
        Log::debug('GeminiService initialized. API Key Length: ' . strlen($this->apiKey ?? ''));
    }

    /**
     * Generate blog content based on context.
     * 
     * @param string $context
     * @return array|null
     */
    public function generateContent($context)
    {
        if (!$this->apiKey) {
            Log::error('Gemini API key is not set.');
            return null;
        }

        $prompt = "You are a professional blog writer for 'Amtech EV', a company that provides EV charging solutions and installations in Malaysia. 
        Generate a blog post based on the following context/topic: '{$context}'.
        
        The response must be in JSON format with the following keys:
        - title: A catchy blog title in English
        - excerpt: A short summary (2-3 sentences) in English
        - content: The full blog post content in English (HTML format, use <p>, <h3>, <ul>, <li> tags)
        - title_ms: The blog title translated to Malaysian
        - excerpt_ms: The summary translated to Malaysian
        - content_ms: The full blog post content translated to Malaysian (HTML format)
        
        Ensure the tone is professional, informative, and SEO-friendly. Focus on the benefits of EV charging for Malaysian drivers.";

        try {
            $response = Http::post($this->apiUrl . '?key=' . $this->apiKey, [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => $prompt]
                        ]
                    ]
                ],
                'generationConfig' => [
                    'response_mime_type' => 'application/json',
                ]
            ]);

            if ($response->successful()) {
                $data = $response->json();
                $text = $data['candidates'][0]['content']['parts'][0]['text'] ?? null;
                
                if ($text) {
                    return json_decode($text, true);
                } else {
                    Log::error('Gemini API Error: No content returned in response. Full response: ' . json_encode($data));
                }
            } else {
                Log::error('Gemini API Error: Request failed with status ' . $response->status() . '. Body: ' . $response->body());
            }
        } catch (\Exception $e) {
            Log::error('Gemini Service Exception: ' . $e->getMessage() . "\nStack Trace: " . $e->getTraceAsString());
        }

        return null;
    }
}
