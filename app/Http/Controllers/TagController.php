<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TagController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Tags', [
            'tags' => Tag::all(),
        ]);
    }

    public function store()
    {
    }

    public function update()
    {
    }

    public function destroy()
    {
    }
}
