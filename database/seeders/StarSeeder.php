<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = Post::all();
        $users = User::all();
        $posts->each(function ($post) use ($users) {
            $starring_users = $users->random(rand(1, $users->count() / 5));
            $starring_users->each(function ($user) use ($post) {
                $post->stars()->attach($user->id);
                $post->increment('total_stars');
            });
        });
    }
}
