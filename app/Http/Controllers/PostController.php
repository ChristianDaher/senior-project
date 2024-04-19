<?php

namespace App\Http\Controllers;

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

    public function store(Request $request)
    {

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
