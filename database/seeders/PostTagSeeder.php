<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $postTags = [
            [
                'post_id' => 1,
                'tag_id' => 1,
            ],
            [
                'post_id' => 1,
                'tag_id' => 2,
            ],
            [
                'post_id' => 2,
                'tag_id' => 3,
            ],
            [
                'post_id' => 2,
                'tag_id' => 4,
            ],
            [
                'post_id' => 2,
                'tag_id' => 5,
            ],
            [
                'post_id' => 3,
                'tag_id' => 1,
            ],
            [
                'post_id' => 3,
                'tag_id' => 2,
            ],
            [
                'post_id' => 4,
                'tag_id' => 1,
            ],
            [
                'post_id' => 4,
                'tag_id' => 3,
            ],
            [
                'post_id' => 4,
                'tag_id' => 4,
            ],
            [
                'post_id' => 5,
                'tag_id' => 5,
            ],
            [
                'post_id' => 5,
                'tag_id' => 1,
            ],
            [
                'post_id' => 5,
                'tag_id' => 4,
            ],
            [
                'post_id' => 5,
                'tag_id' => 3,
            ],
        ];

        $now = now();

        foreach ($postTags as &$postTag) {
            $postTag['created_at'] = $now;
            $postTag['updated_at'] = $now;
        }

        DB::table('post_tag')->insert($postTags);
    }
}
