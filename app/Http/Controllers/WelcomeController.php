<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Inertia\Inertia;

class WelcomeController extends Controller
{
    public function index()
    {
        return Inertia::render('Welcome/Index');
    }

    public function faq()
    {
        $faqs = Faq::orderBy('order')->get();

        return Inertia::render('Faq', [
            'faqs' => $faqs,
        ]);
    }
}
