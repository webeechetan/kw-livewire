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
                'model' => 'gpt-3.5-turbo', // Use 'gpt-4' if needed
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
                'model' => 'gpt-3.5-turbo', // Use 'gpt-4' if needed
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
     * @param array $contentPlanBrief
     * @param array $projectBrief
     * @return array
     */
    public function generateContentPlan(
        string $projectName,
        array $contentPlanBrief,
        array $projectBrief
    ) {
        $platformsList = implode(', ', $contentPlanBrief['platforms']);

        $prompt = <<<EOT
Generate a social media content plan for the brand "{$projectName}" from {$contentPlanBrief['start_date']} to {$contentPlanBrief['end_date']}.

Brand Information:
- Description: {$projectBrief['description']}
- Objective: {$projectBrief['objectives']}
- Timeline: {$projectBrief['timelines']}
- Voice: {$projectBrief['toneOfVoice']}
- Avoid: {$projectBrief['avoidWords']}
- Competitors: {$projectBrief['competitors']}
- Platforms: {$platformsList}

Content Plan Details:
- Title: {$contentPlanBrief['title']}
- Description: {$contentPlanBrief['description']}
- Number of Posts: {$contentPlanBrief['number_of_posts']}

Instructions:
- Create exactly {$contentPlanBrief['number_of_posts']} content items.
- Spread them evenly across the date range.
- Use varied formats: Text, Image, Video, Story, Live Stream, Poll & Quiz.
- Align each post with brand voice and goals.
- Tailor content based on platform.

Each content item must include:
- date (within the given range)
- platform (from: {$platformsList})
- format (e.g., Text, Image, Video, Story, Live Stream, Poll & Quiz)
- bucket (e.g., Educational, Promotional, Behind-the-Scenes, Testimonial, User-Generated Content, Product Highlight, etc.)
- idea (a short content idea in 1–2 sentences)

Provide the output strictly in the following JSON array format:
[
  {
    "date": "YYYY-MM-DD",
    "platform": "Facebook | Instagram | X | YouTube | etc.",
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
                        'content' => "You are an expert social media content plan generator. Your task is to create detailed, creative, and platform-specific content plans for the brand {$projectName} across the following platforms: {$platformsList}. Ensure each post aligns with the brand's voice, goals, and audience, and is tailored for maximum engagement on each platform.",
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
