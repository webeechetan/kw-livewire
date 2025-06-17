<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class OpenAIService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://api.openai.com/v1/',
            'headers' => [
                'Authorization' => 'Bearer ' . env('OPEN_AI_API_KEY'),
                'Content-Type' => 'application/json',
            ],
            'verify' => false // Disable SSL verification
        ]);
    }

    public function query(string $prompt): string
    {
        $response = $this->client->post('chat/completions', [
            'json' => [
                'model' => 'gpt-3.5-turbo', // Use 'gpt-4' if needed
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => 'You are an SQL query generator.',
                    ],
                    [
                        'role' => 'user',
                        'content' => $prompt,
                    ],
                ],
                'max_tokens' => 150,
            ],
        ]);

        $response = json_decode($response->getBody(), true);
        return $response['choices'][0]['message']['content'];
    }

    /**
     * Generate a human-readable text response from query results.
     */
    public function generateHumanReadableResponse(string $userInput, array $results)
    {
        $prompt = "Convert the following JSON data into a human-readable format. Exclude ids and updated_at. The data you are converting is going to text to speech so give data accordingly. Make it concise and clear:\n\n" . json_encode($results, JSON_PRETTY_PRINT);
        $response = $this->client->post('chat/completions', [
            'json' => [
                'model' => 'gpt-3.5-turbo',
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => 'You are a data interpreter.',
                    ],
                    [
                        'role' => 'user',
                        'content' => $prompt,
                    ],
                ],
                'max_tokens' => 150,
            ],
        ]);

        $response = json_decode($response->getBody(), true);
        return $response['choices'][0]['message']['content'];
    }

    /**
     * Generate a social media post from the given content.
     * @param string $content
     */

    public function generateSocialMediaPost(string $content)
    {
        $prompt = "Generate a social media post from the following content:\n\n" . $content;
        $response = $this->client->post('chat/completions', [
            'json' => [
                'model' => 'gpt-3.5-turbo',
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => 'You are a social media post generator.',
                    ],
                    [
                        'role' => 'user',
                        'content' => $prompt,
                    ],
                ],
                'max_tokens' => 150,
            ],
        ]);

        $response = json_decode($response->getBody(), true);
        return $response['choices'][0]['message']['content'];
    }

    /**
     * Generate a detailed content plan for a brand within a date range.
     * @param string $projectName
     * @param array $projectBrief
     * @param array $contentPlanBrief
     * @return array
     */
    public function generateContentPlan(
        string $projectName,
        array $projectBrief,
        array $contentPlanBrief
    ) {

        $platforms = !empty($contentPlanBrief['platforms'])
            ? $contentPlanBrief['platforms']
            : $projectBrief['platforms'];

        $prompt = <<<EOT
    Generate a social media content plan for the brand "{$projectName}" from {$contentPlanBrief['start_date']} to {$contentPlanBrief['end_date']}.
    
    IMPORTANT CONSTRAINTS:
    - Platform: ONLY use {$platforms}
    - Format: {$contentPlanBrief['description']}
    - Number of posts: EXACTLY {$contentPlanBrief['number_of_posts']}
    
    Brand Information:
    - Description: {$projectBrief['description']}
    - Objective: {$projectBrief['objectives']}
    - Timeline: {$projectBrief['timelines']}
    - Voice: {$projectBrief['toneOfVoice']}
    - Avoid: {$projectBrief['avoidWords']}
    - Competitors: {$projectBrief['competitors']}
    
    Content Plan Details:
    - Title: {$contentPlanBrief['title']}
    - Description: {$contentPlanBrief['description']}
    
    STRICT REQUIREMENTS:
    - ALL posts MUST be on {$platforms} ONLY
    - Create EXACTLY {$contentPlanBrief['number_of_posts']} posts
    - Spread posts evenly across the date range
    - Each post must align with brand voice and goals
    
    Each content item must include:
    - date (within the given range)
    - platform (MUST be {$platforms})
    - format (e.g., Text, Image, Video, Story, Live Stream, Poll & Quiz)
    - bucket (e.g., Educational, Promotional, Behind-the-Scenes, Testimonial, User-Generated Content, Product Highlight, etc.)
    - idea (a short content idea in 1–2 sentences)
    
    Provide the output strictly in the following JSON array format:
    [
      {
        "date": "YYYY-MM-DD",
        "platform": "{$platforms}",
        "format": "Text | Image | Video | Story | Live Stream | Poll & Quiz",
        "bucket": "Educational | Promotional | Behind-the-Scenes | Testimonial | User-Generated Content | Product Highlight | etc.",
        "idea": "Concise 1-2 sentence description of the content idea"
      }
    ]
    EOT;

        $response = $this->client->post('chat/completions', [
            'json' => [
                'model' => 'gpt-4',
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => "You are an expert social media content plan generator. You MUST strictly follow these rules:
                        1. ONLY use the specified platform: {$platforms}
                        2. Generate EXACTLY {$contentPlanBrief['number_of_posts']} posts
                        Do not deviate from these constraints under any circumstances.",
                    ],
                    [
                        'role' => 'user',
                        'content' => $prompt,
                    ],
                ],
                'max_tokens' => 1200,
            ],
        ]);

        $response = json_decode($response->getBody(), true);
        return json_decode($response['choices'][0]['message']['content'], true);
    }

    public function regeneratePost($post)
    {
        $prompt = "Regenerate the post for the following content: \n\n" . $post->description;
        $response = $this->client->post('chat/completions', [
            'json' => [
                'model' => 'gpt-4',
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => 'You are given a post and you need to regenerate it. You need to keep the same tone and style of the post. '
                    ],
                    [
                        'role' => 'user',
                        'content' => $prompt,
                    ],
                ],
            ],
        ]);

        $response = json_decode($response->getBody(), true);
        Log::info($response);
        return $response['choices'][0]['message']['content'];
    }
}
