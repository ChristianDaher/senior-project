<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Faq::create([
            'order' => 1,
            'question' => 'How can I use the Crop Prediction Feature?',
            'answer' => 'To use the Crop Prediction Feature, you need to sign up and log in. After that, you can access the Crop Prediction Feature from the forum in the "Prompt section".',
        ]);

        Faq::create([
            'order' => 2,
            'question' => 'How can I share an interesting topic?',
            'answer' => 'To share a topic publicly, you will need to post it using the "Post" feature. You can access the "Post" feature from the forum.',
        ]);

        Faq::create([
            'order' => 3,
            'question' => 'Where can I access my starred posts?',
            'answer' => 'To access your starred posts, click on your profile on the top right to open the dropdown, and click on the "Starred" tab. You will find all your starred posts there.',
        ]);

        Faq::create([
            'order' => 4,
            'question' => 'How can I like a post?',
            'answer' => 'To like a post, click on the heart icon below the post. The heart icon will turn red, indicating that you have liked the post.',
        ]);

        Faq::create([
            'order' => 5,
            'question' => 'How can I comment and see other comments on a post?',
            'answer' => 'To comment on a post and see its comments, click on the comment icon below the post. You will be redirected to page specific for that post, where you can type your comment and check what other people think.',
        ]);
    }
}
