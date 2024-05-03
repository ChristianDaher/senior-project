<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = Post::all();
        $users = User::all();
        $posts->each(function ($post) use ($users) {
            $commenting_users = $users->random(rand(5, 25));
            $commenting_users->each(function ($user) use ($post) {
                $post->comments()->create([
                    'user_id' => $user->id,
                    'content' => fake()->sentence,
                ]);
                $post->increment('total_comments');
            });
        });
    }
}
