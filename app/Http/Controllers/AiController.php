<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AiController extends Controller
{
    public function chat(Request $request)
    {
        $userInput = $request->input('message');

        // Kirim chat ke Ollama (Dolphin-Llama3)
        $response = Http::post('http://localhost:11434/api/generate', [
            'model' => 'dolphin-llama3',
            'prompt' => "Kamu adalah teman chat yang asik. Jawab dengan singkat dan seru. User bertanya: " . $userInput,
            'stream' => false,
        ]);

        return response()->json([
            'reply' => $response->json()['response'] ?? 'AI lagi tidur, cek Ollama kamu!'
        ]);
    }
}