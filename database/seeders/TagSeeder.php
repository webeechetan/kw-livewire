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
            ['name' => 'Meeting', 'color' => '#ffa500'],
            ['name' => 'Post', 'color' => '#0000ff'],
            ['name' => 'Client Event', 'color' => '#A020F0'],
            ['name' => 'Office Event', 'color' => '#008000'],
            ['name' => 'Stuck', 'color' => '#ff0000'],
            ['name' => 'Waiting', 'color' => '#333'],
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
