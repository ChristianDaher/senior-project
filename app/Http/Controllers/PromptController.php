<?php

namespace App\Http\Controllers;

use App\Http\Requests\FreePromptRequest;
use App\Models\Prompt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
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

            Log::info($response->json()['candidates'][0]['content']['parts'][0]['text']);

            $prompt->update([
                'response' => $response->json()['candidates'][0]['content']['parts'][0]['text'],
            ]);

        } catch (\Error $e) {
        }

        return response()->json($prompt);
    }
}
