<?php

namespace App\Http\Controllers;

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

        // $totalPostsCount = Post::count();
        // $newlyCreatedPostsCount = Post::whereBetween('created_at', [now()->subWeek(), now()])->count();
        // $newlyDeletedPostsCount = Post::onlyTrashed()->whereBetween('deleted_at', [now()->subWeek(), now()])->count();
        // $newPostsCount = $newlyCreatedPostsCount - $newlyDeletedPostsCount;

        // $totalPromptsCount = Prompt::count();
        // $newlyCreatedPromptsCount = Prompt::whereBetween('created_at', [now()->subWeek(), now()])->count();
        // $newlyDeletedPromptsCount = Prompt::onlyTrashed()->whereBetween('deleted_at', [now()->subWeek(), now()])->count();
        // $newPromptsCount = $newlyCreatedPromptsCount - $newlyDeletedPromptsCount;

        $totalPostsCount = $totalUsersCount * 3;
        $newPostsCount = $newUsersCount * -2;

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
                ],
                'posts' => [
                    'title' => 'Total Posts',
                    'stat' => $totalPostsCount,
                    'change' => $newPostsCount,
                ],
                'prompts' => [
                    'title' => 'Total Prompts',
                    'stat' => $totalPromptsCount,
                    'change' => $newPromptsCount,
                ],
            ]
        ]);
    }
}
