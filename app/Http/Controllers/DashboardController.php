<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $posts = Post::with('tags')->get();

        dd($posts);

        return Inertia::render('Dashboard', [
            'posts' => $posts,
        ]);
    }
}
