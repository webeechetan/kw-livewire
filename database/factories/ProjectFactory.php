<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Project;
use App\Helpers\Helper;
use App\Models\Client;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'org_id' => '1', 
            'client_id' => Client::factory(),
            'name' => $this->faker->name(),
            'description' => $this->faker->text(),
            'image' => Helper::createAvatar($this->faker->name,'projects')
        ];
    }
}
