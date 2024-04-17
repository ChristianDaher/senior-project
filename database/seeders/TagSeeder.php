<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            ['title' => 'Urgent', 'color' => '#FF0000'],
            ['title' => 'Question', 'color' => '#0000FF'],
            ['title' => 'Discussion', 'color' => '#FFFF00'],
            ['title' => 'DIY', 'color' => '#FF00FF'],
            ['title' => 'I want to learn', 'color' => '#00FF00'],
        ];

        $now = now();
        
        foreach ($tags as &$tag) {
            $tag['created_at'] = $now;
            $tag['updated_at'] = $now;
        }

        Tag::insert($tags);
    }
}
