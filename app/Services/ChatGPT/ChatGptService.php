<?php

declare(strict_types=1);

namespace App\Services\ChatGPT;

use App\Models\Chat;
use App\Models\ChatGptChats;
use OpenAI;

class ChatGptService
{

    private $roles = [
        'system', 'user', 'assistant'
    ];

    private $models = [
        'gpt-3.5-turbo', 'gpt-4'
    ];

    private $temperature;

    private $chatId;

    private OpenAI\Client $client;

    public function __construct()
    {
        $apiKey = getenv('CHAT_GPT_API_KEY');

        $this->client = OpenAI::client($apiKey);
    }

    /**
     * @param $message
     *
     * @return string
     */
    public function get($message): string
    {
        $messages = [
            ['role' => 'system', 'content' => 'Ты исторический консультант'],
            ['role' => 'user', 'content' => $message],
        ];

            $response = $this->client->chat()->create([
                'model' => 'gpt-3.5-turbo',
                'messages' => $messages
            ]);

            $mes = $response->choices[0]->message->content;

            return $mes;
//            $messages[] = ['role' => 'assistant', 'content' => $mes];
    }

    public function listModels()
    {
        $response = $this->client->models()->list();

        $response->object; // 'list'

        foreach ($response->data as $result) {
            $result->id; // 'text-davinci-003'
            $result->object; // 'model'
            // ...
        }

        $response->toArray();
    }
}
