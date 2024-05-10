<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\Post;
use App\Models\Prompt;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class AdminController extends Controller
{
    public function index()
    {
        $totalUsersCount = User::count();
        $newlyRegisteredUsersCount = User::whereBetween('created_at', [now()->subWeek(), now()])->count();
        $newlyDeletedUsersCount = User::onlyTrashed()->whereBetween('deleted_at', [now()->subWeek(), now()])->count();
        $newUsersCount = $newlyRegisteredUsersCount - $newlyDeletedUsersCount;
        $userCountGroupedByProvider = User::select('provider', DB::raw('count(*) as total'))
            ->groupBy('provider')
            ->get()
            ->pluck('total', 'provider')
            ->mapWithKeys(function ($value, $key) {
                return [$key ?: 'The Application' => $value];
            });

        $totalPostsCount = Post::count();
        $newlyCreatedPostsCount = Post::whereBetween('created_at', [now()->subWeek(), now()])->count();
        $newlyDeletedPostsCount = Post::onlyTrashed()->whereBetween('deleted_at', [now()->subWeek(), now()])->count();
        $newPostsCount = $newlyCreatedPostsCount - $newlyDeletedPostsCount;
        $postsPerDay = Post::select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
            ->where('created_at', '>=', now()->subDays(6))
            ->groupBy('date')
            ->orderBy('date', 'DESC')
            ->get()
            ->keyBy('date');

        $now = now();
        for ($i = 6; $i >= 0; $i--) {
            $date = $now->copy()->subDays($i)->format('Y-m-d');
            if (!isset($postsPerDay[$date])) {
                $postsPerDay[$date] = ['date' => $date, 'count' => 0];
            }
        }
        $postsPerDay = $postsPerDay->sortBy('date')->values();

        $totalPromptsCount = Prompt::count();
        $newPromptsCount = Prompt::whereBetween('created_at', [now()->subWeek(), now()])->count();
        $mostPredictedCrops = Prompt::select(DB::raw("response->'$.predicted_crop' as predicted_crop"), DB::raw('count(*) as count'))
            ->where('type', 'paid')
            ->groupBy('predicted_crop')
            ->orderBy('count', 'desc')
            ->limit(5)
            ->get()
            ->pluck('count', 'predicted_crop');

        foreach ($mostPredictedCrops as $key => $value) {
            $newKey = trim($key, '"');
            $mostPredictedCrops[$newKey] = $value;
            unset($mostPredictedCrops[$key]);
        }

        $totalTagsCount = Tag::count();
        $newTagsCount = Tag::whereBetween('created_at', [now()->subWeek(), now()])->count();
        $mostUsedTags = Tag::withCount('posts')
            ->orderBy('posts_count', 'desc')
            ->limit(5)
            ->get()
            ->pluck('posts_count', 'title');

        $totalFaqsCount = Faq::count();
        $newFaqsCount = Faq::whereBetween('created_at', [now()->subWeek(), now()])->count();

        return Inertia::render('Admin/Index', [
            'when' => 'Last 7 Days',
            'stats' => [
                'users' => [
                    'title' => 'Total Users',
                    'stat' => $totalUsersCount,
                    'change' => $newUsersCount,
                    'providers' => $userCountGroupedByProvider,
                    'route' => 'admin.users.index',
                ],
                'posts' => [
                    'title' => 'Total Posts',
                    'stat' => $totalPostsCount,
                    'change' => $newPostsCount,
                    'perDay' => $postsPerDay,
                    'route' => 'forum',
                ],
                'prompts' => [
                    'title' => 'Total Prompts',
                    'stat' => $totalPromptsCount,
                    'change' => $newPromptsCount,
                    'mostPredictedCrops' => $mostPredictedCrops,
                    'route' => 'admin.prompts.index',
                ],
                'tags' => [
                    'title' => 'Total Tags',
                    'stat' => $totalTagsCount,
                    'change' => $newTagsCount,
                    'mostUsed' => $mostUsedTags,
                    'route' => 'admin.tags.index',
                ],
                'faqs' => [
                    'title' => 'All FAQs',
                    'stat' => $totalFaqsCount,
                    'change' => $newFaqsCount,
                    'route' => 'admin.faqs.index',
                ],
            ]
        ]);
    }
}
