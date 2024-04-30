<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LikeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = Post::all();
        $users = User::all();
        $posts->each(function ($post) use ($users) {
            $liking_users = $users->random(rand(1, $users->count() / 2));
            $liking_users->each(function ($user) use ($post) {
                $post->likes()->create([
                    'user_id' => $user->id,
                ]);
                $post->increment('total_likes');
            });
        });
    }
}
