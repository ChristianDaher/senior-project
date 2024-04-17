<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Inertia\Inertia;

class WelcomeController extends Controller
{
    public function index()
    {
        // $body = [
        //     "n" => 10,
        //     "p" => 120,
        //     "k" => 120,
        //     "temp" => 10,
        //     "h" => 30,
        //     "ph" => 10,
        //     "rain" => 20
        // ];

        // $response = Http::withHeaders(['Authorization' => 'Bearer ' . config("app.api_secret_key")])
        //     ->post(config("app.api_url") . '/prediction', $body);

        // $response = Http::post("https://generativelanguage.googleapis.com/v1beta/models/gemini-pro:generateContent?key=" . config("app.google_api_key"), [
        //     "contents" => [
        //         [
        //             "parts" => [
        //                 [
        //                     "text" => "The temperature is around 30 degrees celcius, I live in the middle east and have a small garden in my backyard. What could be the best crop to grow?",
        //                 ]
        //             ]
        //         ]
        //     ],
        // ]);

        // dd($response->json());

        return Inertia::render('Welcome/Index');
    }
}
