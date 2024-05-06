<?php

namespace App\Http\Controllers;

use App\Models\Post;
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

        // $totalPromptsCount = Prompt::count();
        // $newlyCreatedPromptsCount = Prompt::whereBetween('created_at', [now()->subWeek(), now()])->count();
        // $newlyDeletedPromptsCount = Prompt::onlyTrashed()->whereBetween('deleted_at', [now()->subWeek(), now()])->count();
        // $newPromptsCount = $newlyCreatedPromptsCount - $newlyDeletedPromptsCount;

        $totalTagsCount = Tag::count();
        $newTagsCount = Tag::whereBetween('created_at', [now()->subWeek(), now()])->count();
        $mostUsedTags = Tag::withCount('posts')
            ->orderBy('posts_count', 'desc')
            ->limit(5)
            ->get()
            ->pluck('posts_count', 'title');

        $totalPromptsCount = $totalUsersCount * 2;
        $newPromptsCount = $newUsersCount;

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
                    'route' => 'dashboard',
                ],
                'prompts' => [
                    'title' => 'Total Prompts',
                    'stat' => $totalPromptsCount,
                    'change' => $newPromptsCount,
                    'route' => 'admin.prompts.index',
                ],
                'tags' => [
                    'title' => 'Total Tags',
                    'stat' => $totalTagsCount,
                    'change' => $newTagsCount,
                    'mostUsed' => $mostUsedTags,
                    'route' => 'admin.tags.index',
                ],
            ]
        ]);
    }
}
