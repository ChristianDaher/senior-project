<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Http\Requests\PostStoreRequest;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class PostController extends Controller
{
    public function adminIndex()
    {
        dd('View all posts');
    }

    public function create()
    {
        return Inertia::render('Posts/Create', [
            'tags' => Tag::all(),
        ]);
    }

    public function store(PostStoreRequest $request)
    {
        $storage = Storage::getDefaultDriver();
        $image_url = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '-' . $image->getClientOriginalName();
            if ($storage == 'local') {
                $image_url = $image->storeAs('public/images', $filename);
                $image_url = str_replace('public/', '/storage/', $image_url);
            }
            //fix here in case we use another storage system
        }

        $post = Post::create([
            'user_id' => auth()->user()->id,
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'image_url' => $image_url,
        ]);

        $post->tags()->attach($request->input('tags'));

        return redirect()->route('dashboard');
    }

    public function show(string $id)
    {
        $post = Post::with(['comments' => function ($query) {
            $query->orderBy('created_at', 'desc');
        }, 'comments.user'])->findOrFail($id);

        return Inertia::render('Posts/Show', [
            'post' => $post,
        ]);
    }

    public function edit(string $id)
    {
    }

    public function update(Request $request, string $id)
    {
    }

    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
    }

    public function adminUpdate(Request $request, string $id)
    {
    }

    public function adminDestroy(string $id)
    {
    }

    public function like(string $id)
    {
        $post = Post::findOrFail($id);
        try {
            $post->likes()->attach(auth()->user()->id);
            $post->increment('total_likes');
        } catch (\Exception $e) {
        }
    }

    public function unlike(string $id)
    {
        $post = Post::findOrFail($id);
        $success = $post->likes()->detach(auth()->user()->id);
        if ($success) $post->decrement('total_likes');
    }

    public function star(string $id)
    {
        $post = Post::findOrFail($id);
        try {
            $post->stars()->attach(auth()->user()->id);
            $post->increment('total_stars');
        } catch (\Exception $e) {
        }
    }

    public function unstar(string $id)
    {
        $post = Post::findOrFail($id);
        $success = $post->stars()->detach(auth()->user()->id);
        if ($success) $post->decrement('total_stars');
    }

    public function comment(CommentRequest $request, string $id)
    {
        $post = Post::findOrFail($id);
        try {
            $post->comments()->create([
                'user_id' => auth()->user()->id,
                'content' => $request->input('content'),
            ]);
            $post->increment('total_comments');
        } catch (\Exception $e) {
        }
    }

    public function uncomment(string $id, string $commentId)
    {
        $post = Post::findOrFail($id);
        $success = $post->comments()->findOrFail($commentId)->delete();
        if ($success) $post->decrement('total_comments');
    }
}
