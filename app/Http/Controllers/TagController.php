<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class TagController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Tags');
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