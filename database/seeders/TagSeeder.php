<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Tag;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            ['name' => 'Meeting'],
            ['name' => 'Post'],
            ['name' => 'Client Event'],
            ['name' => 'Office Event'],
            ['name' => 'Stuck'],
            ['name' => 'Waiting'],
        ];

        foreach ($tags as $tag) {
            Tag::create([
                'name' => $tag['name'],
            ]);
        }
    }
}
