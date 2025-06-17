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

    /**
     * Generate post copy for social media captions
     * @param array $projectBrief
     * @param array $contentPlanBrief
     * @param array $postBrief
     * @return string
     */
    public function generatePostCopy(array $projectBrief, array $contentPlanBrief, array $postBrief)
    {
        // Skip generation for story format
        if (strtolower($postBrief['format']) === 'story') {
            return 'Story format does not require post copy.';
        }

        $prompt = <<<EOT
        Generate a compelling social media post caption for the following content:

        BRAND INFORMATION:
        - Description: {$projectBrief['description']}
        - Tone of Voice: {$projectBrief['toneOfVoice']}
        - Words to Avoid: {$projectBrief['avoidWords']}

        CONTENT PLAN CONTEXT:
        - Description: {$contentPlanBrief['description']}

        POST DETAILS:
        - Content Idea: {$postBrief['content_idea']}
        - Content Bucket: {$postBrief['content_bucket']}
        - Format: {$postBrief['format']}
        - Platform: {$postBrief['platforms']}

        REQUIREMENTS:
        - Create an engaging caption that matches the brand's tone of voice
        - Include relevant hashtags for the platform
        - Keep it concise but impactful
        - Avoid using the specified words to avoid
        - Make it platform-appropriate for {$postBrief['platforms']}
        - Ensure it complements the content idea and bucket

        Generate only the caption text without any additional formatting or explanations.
        EOT;

        $response = $this->client->post('chat/completions', [
            'json' => [
                'model' => 'gpt-4',
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => 'You are an expert social media copywriter specializing in creating engaging post captions that drive engagement and align with brand voice.',
                    ],
                    [
                        'role' => 'user',
                        'content' => $prompt,
                    ],
                ],
                'max_tokens' => 300,
            ],
        ]);

        $response = json_decode($response->getBody(), true);
        return $response['choices'][0]['message']['content'];
    }

    /**
     * Generate creative copy for visual elements
     * @param array $projectBrief
     * @param array $contentPlanBrief
     * @param array $postBrief
     * @return string
     */
    public function generateCreativeCopy(array $projectBrief, array $contentPlanBrief, array $postBrief)
    {
        // Skip generation for text and polls & quiz formats
        $excludedFormats = ['text', 'poll & quiz'];
        if (in_array(strtolower($postBrief['format']), $excludedFormats)) {
            return 'Creative copy not applicable for ' . $postBrief['format'] . ' format.';
        }

        $prompt = <<<EOT
        Generate creative copy to be placed on visual elements (images, video frames) for the following content:

        BRAND INFORMATION:
        - Description: {$projectBrief['description']}
        - Tone of Voice: {$projectBrief['toneOfVoice']}
        - Words to Avoid: {$projectBrief['avoidWords']}

        CONTENT PLAN CONTEXT:
        - Description: {$contentPlanBrief['description']}

        POST DETAILS:
        - Content Idea: {$postBrief['content_idea']}
        - Content Bucket: {$postBrief['content_bucket']}
        - Format: {$postBrief['format']}
        - Platform: {$postBrief['platforms']}

        REQUIREMENTS:
        - Create short, impactful text that can be overlaid on visual content
        - Keep it to 1-3 lines maximum
        - Make it visually appealing and easy to read
        - Match the brand's tone of voice
        - Avoid using the specified words to avoid
        - Ensure it works well with the content format: {$postBrief['format']}
        - Make it platform-appropriate for {$postBrief['platforms']}

        Generate only the creative copy text without any additional formatting or explanations.
        EOT;

        $response = $this->client->post('chat/completions', [
            'json' => [
                'model' => 'gpt-4',
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => 'You are an expert creative copywriter specializing in creating impactful text for visual content that captures attention and communicates brand messages effectively.',
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
     * Generate visual direction for content creation
     * @param array $projectBrief
     * @param array $contentPlanBrief
     * @param array $postBrief
     * @return string
     */
    public function generateVisualDirection(array $projectBrief, array $contentPlanBrief, array $postBrief)
    {
        // Skip generation for text and polls & quiz formats
        $excludedFormats = ['text', 'poll & quiz'];
        if (in_array(strtolower($postBrief['format']), $excludedFormats)) {
            return 'Visual direction not applicable for ' . $postBrief['format'] . ' format.';
        }

        $prompt = <<<EOT
        Generate detailed visual direction for creating visual content based on the following:

        BRAND INFORMATION:
        - Description: {$projectBrief['description']}
        - Tone of Voice: {$projectBrief['toneOfVoice']}
        - Words to Avoid: {$projectBrief['avoidWords']}

        CONTENT PLAN CONTEXT:
        - Description: {$contentPlanBrief['description']}

        POST DETAILS:
        - Content Idea: {$postBrief['content_idea']}
        - Content Bucket: {$postBrief['content_bucket']}
        - Format: {$postBrief['format']}
        - Platform: {$postBrief['platforms']}

        REQUIREMENTS:
        Provide detailed visual direction including:
        - Color palette and mood
        - Typography style and hierarchy
        - Layout composition suggestions
        - Visual elements and imagery recommendations
        - Brand consistency guidelines
        - Platform-specific considerations for {$postBrief['platforms']}
        - Format-specific requirements for {$postBrief['format']}

        Make the direction actionable and specific for content creators.
        EOT;

        $response = $this->client->post('chat/completions', [
            'json' => [
                'model' => 'gpt-4',
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => 'You are an expert visual designer and art director specializing in creating detailed visual direction for social media content that aligns with brand identity and platform requirements.',
                    ],
                    [
                        'role' => 'user',
                        'content' => $prompt,
                    ],
                ],
                'max_tokens' => 500,
            ],
        ]);

        $response = json_decode($response->getBody(), true);
        return $response['choices'][0]['message']['content'];
    }

    /**
     * Regenerate creative copy for visual elements
     * @param array $projectBrief
     * @param array $contentPlanBrief
     * @param array $postBrief
     * @return string
     */
    public function regenerateCreativeCopy(array $projectBrief, array $contentPlanBrief, array $postBrief)
    {
        // Skip generation for text and polls & quiz formats
        $excludedFormats = ['text', 'poll & quiz'];
        if (in_array(strtolower($postBrief['format']), $excludedFormats)) {
            return 'Creative copy not applicable for ' . $postBrief['format'] . ' format.';
        }

        $existingCreativeCopy = $postBrief['creative_copy'] ?? 'No existing creative copy available.';

        $prompt = <<<EOT
Regenerate the creative copy for visual elements. Here's the existing copy to improve upon:

EXISTING CREATIVE COPY:
{$existingCreativeCopy}

BRAND INFORMATION:
- Description: {$projectBrief['description']}
- Tone of Voice: {$projectBrief['toneOfVoice']}
- Words to Avoid: {$projectBrief['avoidWords']}

CONTENT PLAN CONTEXT:
- Description: {$contentPlanBrief['description']}

POST DETAILS:
- Content Idea: {$postBrief['content_idea']}
- Content Bucket: {$postBrief['content_bucket']}
- Format: {$postBrief['format']}
- Platform: {$postBrief['platforms']}

REQUIREMENTS:
- Create a new version of the creative copy that can be overlaid on visual content
- Keep it to 1-3 lines maximum
- Make it visually appealing and easy to read
- Match the brand's tone of voice
- Avoid using the specified words to avoid
- Ensure it works well with the content format: {$postBrief['format']}
- Make it platform-appropriate for {$postBrief['platforms']}
- Maintain the same core message but improve the execution

Generate only the new creative copy text without any additional formatting or explanations.
EOT;

        $response = $this->client->post('chat/completions', [
            'json' => [
                'model' => 'gpt-4',
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => 'You are an expert creative copywriter specializing in creating impactful text for visual content. You excel at improving and regenerating copy while maintaining brand consistency.',
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
     * Regenerate post copy for social media captions
     * @param array $projectBrief
     * @param array $contentPlanBrief
     * @param array $postBrief
     * @return string
     */
    public function regeneratePostCopy(array $projectBrief, array $contentPlanBrief, array $postBrief)
    {
        // Skip generation for story format
        if (strtolower($postBrief['format']) === 'story') {
            return 'Story format does not require post copy.';
        }

        $existingPostCopy = $postBrief['post_copy'] ?? 'No existing post copy available.';

        $prompt = <<<EOT
Regenerate the social media post caption. Here's the existing caption to improve upon:

EXISTING POST COPY:
{$existingPostCopy}

BRAND INFORMATION:
- Description: {$projectBrief['description']}
- Tone of Voice: {$projectBrief['toneOfVoice']}
- Words to Avoid: {$projectBrief['avoidWords']}

CONTENT PLAN CONTEXT:
- Description: {$contentPlanBrief['description']}

POST DETAILS:
- Content Idea: {$postBrief['content_idea']}
- Content Bucket: {$postBrief['content_bucket']}
- Format: {$postBrief['format']}
- Platform: {$postBrief['platforms']}

REQUIREMENTS:
- Create a new engaging caption that matches the brand's tone of voice
- Include relevant hashtags for the platform
- Keep it concise but impactful
- Avoid using the specified words to avoid
- Make it platform-appropriate for {$postBrief['platforms']}
- Ensure it complements the content idea and bucket
- Maintain the same core message but improve the execution
- Consider different angles or approaches while staying true to the content

Generate only the new caption text without any additional formatting or explanations.
EOT;

        $response = $this->client->post('chat/completions', [
            'json' => [
                'model' => 'gpt-4',
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => 'You are an expert social media copywriter specializing in creating engaging post captions that drive engagement and align with brand voice. You excel at improving and regenerating copy.',
                    ],
                    [
                        'role' => 'user',
                        'content' => $prompt,
                    ],
                ],
                'max_tokens' => 300,
            ],
        ]);

        $response = json_decode($response->getBody(), true);
        return $response['choices'][0]['message']['content'];
    }

    /**
     * Regenerate visual direction for content creation
     * @param array $projectBrief
     * @param array $contentPlanBrief
     * @param array $postBrief
     * @return string
     */
    public function regenerateVisualDirection(array $projectBrief, array $contentPlanBrief, array $postBrief)
    {
        // Skip generation for text and polls & quiz formats
        $excludedFormats = ['text', 'poll & quiz'];
        if (in_array(strtolower($postBrief['format']), $excludedFormats)) {
            return 'Visual direction not applicable for ' . $postBrief['format'] . ' format.';
        }

        $existingVisualDirection = $postBrief['visual_direction'] ?? 'No existing visual direction available.';

        $prompt = <<<EOT
Regenerate the visual direction for creating visual content. Here's the existing direction to improve upon:

EXISTING VISUAL DIRECTION:
{$existingVisualDirection}

BRAND INFORMATION:
- Description: {$projectBrief['description']}
- Tone of Voice: {$projectBrief['toneOfVoice']}
- Words to Avoid: {$projectBrief['avoidWords']}

CONTENT PLAN CONTEXT:
- Description: {$contentPlanBrief['description']}

POST DETAILS:
- Content Idea: {$postBrief['content_idea']}
- Content Bucket: {$postBrief['content_bucket']}
- Format: {$postBrief['format']}
- Platform: {$postBrief['platforms']}

REQUIREMENTS:
Provide new detailed visual direction including:
- Color palette and mood (consider different color approaches)
- Typography style and hierarchy
- Layout composition suggestions
- Visual elements and imagery recommendations
- Brand consistency guidelines
- Platform-specific considerations for {$postBrief['platforms']}
- Format-specific requirements for {$postBrief['format']}
- Alternative approaches or variations to consider

Make the direction actionable and specific for content creators. Consider different creative approaches while maintaining brand alignment.
EOT;

        $response = $this->client->post('chat/completions', [
            'json' => [
                'model' => 'gpt-4',
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => 'You are an expert visual designer and art director specializing in creating detailed visual direction for social media content. You excel at improving and regenerating visual guidance while maintaining brand identity.',
                    ],
                    [
                        'role' => 'user',
                        'content' => $prompt,
                    ],
                ],
                'max_tokens' => 500,
            ],
        ]);

        $response = json_decode($response->getBody(), true);
        return $response['choices'][0]['message']['content'];
    }
}
