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
     * Generate a content calendar for a  product brand.
     * @param string $month
     * @param array $brandSettings
     * @param int $frequencyInDays
     * @return array
     */
    public function generateContentCalendar($brandName, $brandSettings, $month, $number_of_posts = 4, $platforms, $goals)
    {
        $prompt = "Create a content calendar for a {$brandName} brand for the month of {$month}. 
            The content should follow these settings:
            - Brand Name: {$brandName}

            - Brand Description: {$brandSettings['brandDescription']}
            - Content Type: {$brandSettings['contentType']}
            - Brand Colors: {$brandSettings['brandColors']}
            - Tone of Voice: {$brandSettings['toneOfVoice']} 
            - Avoid Words: {$brandSettings['avoidWords']}
            - Unique Selling Point: {$brandSettings['uniqueSellingPoint']}
            - Platforms: {$brandSettings['platforms']}
            - Content Goal: {$brandSettings['contentGoal']}
            - Number Of Posts: {$number_of_posts} 

            Provide the output in a JSON format like:
            [
                {
                    \"date\": \"2025-05-01\",
                    \"platform\": \"Twitter\",
                    \"post\": \"<post content>\",
                    \"format\": \"Story\",
                    \"content_bucket\": \"educational, entertaining, or inspirational\",
                    \"content_idea\": \"marketing, blogging, or social media\",
                    


                },
                ...
            ]";

        $response = $this->client->post('chat/completions', [
            'json' => [
                'model' => 'gpt-4',
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => 'You are a content calendar generator.',
                    ],
                    [
                        'role' => 'user',
                        'content' => $prompt,
                    ],
                ],
                'max_tokens' => 1000,
            ],
        ]);

        $response = json_decode($response->getBody(), true);

        return json_decode($response['choices'][0]['message']['content'], true);
    }

    /**
     * Generate a detailed content plan for a brand within a date range.
     * @param string $brandName
     * @param string $startDate
     * @param string $endDate
     * @param array $brandSettings
     * @param int $numberOfPosts
     * @param array $platforms
     * @param array $goals
     * @return array
     */
    public function generateContentPlan(
        string $brandName,
        string $startDate,
        string $endDate,
        array $brandSettings,
        int $numberOfPosts,
        array $platforms,
        array $goals
    ) {
        $platformsList = implode(', ', array: $platforms);
        $goalsList = implode(', ', $goals);

        $prompt = <<<EOT
Generate a social media content plan for the brand "{$brandName}" from {$startDate} to {$endDate}.

Brand Information:
- Description: {$brandSettings['brandDescription']}
- Goals: {$goalsList}
- Objective: {$brandSettings['brandObjective']}
- Timeline: {$brandSettings['campaignTimelines']}
- Voice: {$brandSettings['brandVoice']}
- Avoid: {$brandSettings['avoidWords']}
- Competitors: {$brandSettings['competitors']}
- Platforms: {$platformsList}

Instructions:
- Create exactly {$numberOfPosts} content items.
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
                        'content' => "You are an expert social media content plan generator. Your task is to create detailed, creative, and platform-specific content plans for the brand {$brandName} across the following platforms: {$brandSettings['platforms']}. Ensure each post aligns with the brand\'s voice, goals, and audience, and is tailored for maximum engagement on each platform.",
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
