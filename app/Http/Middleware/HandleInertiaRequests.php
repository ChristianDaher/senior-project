<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): string|null
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        $user = $request->user();
        $liked_post_ids = [];
        $starred_post_ids = [];
        $commented_post_ids = [];
        if($user){
            $liked_post_ids = $user->likedPostIds();
            $starred_post_ids = $user->starredPostIds();
            $commented_post_ids = $user->commentedPostIds();
        }
        return [
            ...parent::share($request),
            'auth' => [
                'user' => $user,
                'likedPostIds' => $liked_post_ids,
                'starredPostIds' => $starred_post_ids,
                'commentedPostIds' => $commented_post_ids,
            ],
        ];
    }
}
