<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostStoreRequest;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
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
        $image_url = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image_url = $image->storeAs('public/images', $filename);
        }

        $post = new Post;
        $post->title = $request->input('title');
        $post->description = $request->input('description');
        $post->image_url = $image_url;
        $post->save();

        $post->tags()->attach($request->input('tags'));

        return redirect()->route('dashboard');
    }

    public function show(string $id)
    {
    }

    public function edit(string $id)
    {
    }

    public function update(Request $request, string $id)
    {
    }

    public function destroy(string $id)
    {
    }

    public function adminUpdate(Request $request, string $id)
    {
    }

    public function adminDestroy(string $id)
    {
    }
}
