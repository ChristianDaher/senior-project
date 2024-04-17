<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = [
            [
                'user_id' => 2,
                'title' => 'How to plant Potatoes in your garden',
                'description' => 'This is a step-by-step guide on plating tomatoes in your garden.',
                'image_url' => 'https://via.placeholder.com/640x480.png/00ff00?text=Urgent',
            ],
            [
                'user_id' => 2,
                'title' => 'How can you make delicious fries at home?',
                'description' => 'I just reap the potatoes from my garden and I want to make some delicious fries at home. Can you help me with a recipe?',
                'image_url' => NULL,
            ],
        ];

        $now = now();
        
        foreach ($posts as &$post) {
            $post['created_at'] = $now;
            $post['updated_at'] = $now;
        }

        Post::insert($posts);
    }
}
