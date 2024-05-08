<?php

namespace App\Http\Controllers;

use App\Http\Requests\FreePromptRequest;
use App\Http\Requests\PaidPromptRequest;
use App\Models\Prompt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Inertia\Inertia;

class PromptController extends Controller
{
    public function index()
    {
        return Inertia::render('Prompts');
    }

    public function adminIndex()
    {
        return Inertia::render('Admin/Prompts', [
            'prompts' => Prompt::all(),
        ]);
    }

    public function storeFree(FreePromptRequest $request)
    {
        $prompt = auth()->user()->prompts()->create([
            'prompt' => json_encode(['message' => $request->prompt]),
            'type' => 'free',
        ]);

        try {
            $response = Http::post("https://generativelanguage.googleapis.com/v1beta/models/gemini-pro:generateContent?key=" . config("app.google_api_key"), [
                "contents" => [
                    [
                        "parts" => [
                            [
                                "text" => json_decode($prompt->prompt, true)['message'],
                            ]
                        ]
                    ]
                ],
            ]);

            $prompt->update([
                'response' => $response->json()['candidates'][0]['content']['parts'][0],
            ]);
        } catch (\Error $e) {
        }

        return response()->json($prompt);
    }

    public function storePaid(PaidPromptRequest $request)
    {
        $prompt = auth()->user()->prompts()->create([
            'prompt' => json_encode($request->all()),
            'type' => 'paid',
        ]);

        try {
            $response = Http::withHeaders(['Authorization' => 'Bearer ' . config("app.api_secret_key")])
                ->post(config("app.api_url") . '/prediction', json_decode($prompt->prompt, true));

            $prompt->update([
                'response' => $response->json(),
            ]);
        } catch (\Error $e) {
        }

        return response()->json($prompt);
    }
}
