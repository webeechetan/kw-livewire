<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $platforms = ['Instagram', 'Facebook', 'YouTube', 'LinkedIn', 'Twitter', 'Pinterest'];
        $postFormats = [
            'Reel', 'Short', 'Live Stream', 'Image Post', 'Carousel Post',
            'Video Post', 'Story', 'Poll', 'Q&A', 'Link Post', 'Text Post',
            'GIF', 'Event Announcement', 'Behind the Scenes', 'Testimonial',
            'Product Showcase', 'Before & After', 'Infographic', 'Meme',
            'Podcast Clip', 'Countdown', 'Tutorial', 'User-Generated Content',
        ];

        return [
            'project_id' => 1, // Replace with dynamic or seeded value
            'content_plan_id' => 1, // Replace with dynamic or seeded value
            'date' => now()->addDays(fake()->numberBetween(0, 30)),
            'platform' => fake()->randomElement($platforms),
            'status' => 'pending',
            'format' => fake()->randomElement($postFormats),
            'content_bucket' => '',
            'content_idea' => '',
            'creative_copy' => '',
            'visual_direction' => '',
            'caption' => '',
        ];
    }
}
