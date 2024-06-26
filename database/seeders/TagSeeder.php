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
            ['title' => 'Urgent', 'color' => '#fa1b3d'],
            ['title' => 'Question', 'color' => '#0a80ff'],
            ['title' => 'Discussion', 'color' => '#3c434a'],
            ['title' => 'DIY', 'color' => '#059e28'],
            ['title' => 'I want to learn', 'color' => '#02c275'],
        ];

        $half = count($tags) / 2;

        foreach ($tags as $index => &$tag) {
            if ($index < $half) {
                $tag['created_at'] = now();
                $tag['updated_at'] = now();
            } else {
                $tag['created_at'] = now()->subDays(30);
                $tag['updated_at'] = now()->subDays(30);
            }
        }

        Tag::insert($tags);
    }
}
