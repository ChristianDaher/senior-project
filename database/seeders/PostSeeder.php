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
                'image_url' => 'https://picsum.photos/400/300',
            ],
            [
                'user_id' => 2,
                'title' => 'How can you make delicious fries at home?',
                'description' => 'I just reap the potatoes from my garden and I want to make some delicious fries at home. Can you help me with a recipe?',
                'image_url' => NULL,
            ],
            [
                'user_id' => 1,
                'title' => 'I have this plant in my garden, can you help me identify it?',
                'description' => 'I have this plant in my garden and I have no idea what it is. Can you help me identify it? I have attached a picture of the plant. I live in the middle east and the temperature is around 30 degrees celcius. I have a small garden in my backyard. What could be the best crop to grow?',
                'image_url' => 'https://picsum.photos/700/480',
            ],
            [
                'user_id' => 1,
                'title' => 'I want to get into gardening, where can I start',
                'description' => 'I have always wanted to get into gardening but I have no idea where to start. Can you help me with some tips? I just got my new house and I have a small backyard. I want to grow some vegetables and fruits.',
                'image_url' => 'https://picsum.photos/480/700',
            ],
            [
                'user_id' => 1,
                'title' => 'I love cooking, can you help me with some recipes?',
                'description' => 'I am growing some vegetables in my garden and I want to make some delicious recipes. Can you help me with some recipes? I have attached a picture of the vegetables I have in my garden.',
                'image_url' => 'https://picsum.photos/900/700',
            ],
            [
                'user_id' => 1,
                'title' => 'My garden is not growing well, can you help me?',
                'description' => 'I need help with my garden. I have a small garden in my backyard and I have been trying to grow some vegetables and fruits but they are not growing well. Can you help me with some tips? I have attached a picture of my garden.',
                'image_url' => 'https://picsum.photos/1440/1440',
            ],
        ];

        $now = now();
        foreach ($posts as &$post) {
            $randomDays = rand(0, 7);
            $post['created_at'] = $now->copy()->subDays($randomDays);
            $post['updated_at'] = $now->copy()->subDays($randomDays);
        }

        Post::insert($posts);
    }
}
