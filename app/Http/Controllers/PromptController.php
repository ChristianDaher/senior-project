<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class PromptController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Prompts');
    }
}
