<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AIController extends Controller
{
    public function index()
    {
        return view('text_generate');
    }

    public function generateText(Request $input) {
        if ($input->title == null) {
            return;
        }
    
        $title = $input->title;
        
        $client = \OpenAI::client('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');
    
        // $result = $client->completions()->create([
        //     "model" => "text-davinci-003",
        //     "temperature" => 0.9,
        //     'max_tokens' => 150,
        //     "top_p" => 1,
        //     "frequency_penalty" => 0,
        //     "presence_penalty" => 0.6,
        //     "best_of" => 1,
        //     'prompt' => $title,
        // ]);
        $result = $client->completions()->create([
            "model" => "text-davinci-002",
            "temperature" => 0.8,
            "max_tokens" => 100,
            "top_p" => 1,
            "frequency_penalty" => 0,
            "presence_penalty" => 0,
            "best_of" => 1,
            "prompt" => $title,
        ]);
    
        $content = trim($result['choices'][0]['text']);
        
        return view('text_generate', compact('title', 'content'));
    }
}
