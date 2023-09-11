<?php

declare(strict_types=1);

namespace App\Services\ChatGPT;

use OpenAI;

class ChatGptService
{
    private OpenAI\Client $client;

    public function __construct()
    {
        $apiKey = getenv('CHAT_GPT_API_KEY');

        $this->client = OpenAI::client($apiKey);
    }

    public function get($message)
    {
        $response = $this->client->chat()->create([
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                ['role' => 'user', 'content' => $message],
            ],
        ]);

        foreach ($response->choices as $result) {
            $answer = $result->message->content;
        }

        return $answer;
    }
}
