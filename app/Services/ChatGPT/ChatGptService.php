<?php

declare(strict_types=1);

namespace App\Services\ChatGPT;

use App\Models\Chat;
use App\Models\ChatGptChats;
use App\Services\AI\Client\AiClient;
use App\Services\AI\Client\OpenAiClient;
use App\Services\AI\DTO\AiCommandDto;
use App\Services\AI\DTO\AiResultDto;
use OpenAI;

class ChatGptService
{
    public function __construct(
        protected AiClient $client
    )
    {
    }

    public function generateGreeting(): AiResultDto
    {
        return $this->client->generate(
            new AiCommandDto(
                'Как экономить бюджет',
                'Сегодня ты финансовый консультант',
            )
        );
    }
}
