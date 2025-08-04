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
            ['name' => 'Urgent', 'color' => '#ff0000'],
            ['name' => 'Meeting', 'color' => '#ffa500'],
            ['name' => 'Optional', 'color' => '#008000'],
            ['name' => 'Post', 'color' => '#0000ff'],
            ['name' => 'Waiting', 'color' => '#808080'],
        ];

        foreach ($tags as $tag) {
            Tag::create([
                'org_id' => 7,
                'created_by' => 3, 
                'name' => $tag['name'],
                'color' => $tag['color'],
            ]);
        }
    }
}
