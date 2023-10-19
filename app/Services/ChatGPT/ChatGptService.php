<?php

declare(strict_types=1);

namespace App\Services\ChatGPT;

use App\Services\AI\Client\AiClient;
use App\Services\AI\DTO\AiCommandDto;
use App\Services\AI\DTO\AiResultDto;

class ChatGptService
{
    public function __construct(
        protected AiClient $client
    )
    {
    }

    public function generateText(string $prompt, $identity): AiResultDto
    {
        return $this->client->generate(
            new AiCommandDto(
                $prompt,
                $identity,
            )
        );
    }
}
