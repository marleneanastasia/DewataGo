<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChatController extends Controller {
    public function index() {
        return view('chat');
    }

public function sendMessage(Request $request)
{
    $userInput = $request->input('message');

    // Gunakan Http::withOptions untuk memperbaiki koneksi
    $response = Http::withOptions([
        'connect_timeout' => 5, // Cepatkan waktu tunggu koneksi
        'timeout' => 60,        // Waktu tunggu respon total 60 detik
    ])->post('http://127.0.0.1:11434/api/generate', [
        
        'model' => 'llama3',
        'prompt' => "cold boyfriend" . $userInput,
        'stream' => false,
    ]);

    if ($response->successful()) {
        return response()->json(['reply' => $response->json()['response']]);
    } else {
        return response()->json(['error' => 'Ollama error: ' . $response->body()], 500);
    }
}}