<?php

declare(strict_types=1);

namespace App\Services\AI\Client;

use App\Services\AI\DTO\AiCommandDto;
use App\Services\AI\DTO\AiContextDto;
use App\Services\AI\DTO\AiResultDto;
use App\Services\AI\Enum\AiContextRole;
use App\Services\AI\Exceptions\AiException;
use Exception;
use OpenAI;
use OpenAI\Client;

class OpenAiClient implements AiClient
{
    protected Client $client;

    public function __construct()
    {
        $this->client = OpenAI::client(config('services.openai.key'));
    }

    public function generate(AiCommandDto $dto): AiResultDto
    {
        try {
            $context = $this->prepareContext($dto->context);

            $result = $this->client->chat()->create([
                'model' => 'gpt-3.5-turbo',
                'messages' => [
                    $this->createContextArray(
                        new AiContextDto(
                            content: $dto->identity,
                            role: AiContextRole::System,
                        )
                    ),
                    ...$context,
                    $this->createContextArray(
                        new AiContextDto(
                            content: $dto->prompt,
                            role: AiContextRole::User,
                        )
                    ),
                ]
            ]);

            $output = str($result['choices'][0]['message']['content'] ?? '')
                ->replace("\n",  ' ')
                ->ltrim('.')
                ->trim()
                ->trim('"')
                ->toString();

            return new AiResultDto(
                output: $output,
                tokens: $result['usage']['total_tokens'],
            );
        } catch (Exception $e) {
            throw new AiException();
        }
    }

    /**
     * @param  array  $contextList
     * @return array
     */
    protected function prepareContext(array $contextList): array
    {
        $output = [];

        /* @var AiContextDto $context */
        foreach ($contextList as $context) {
            $output[] = $this->createContextArray($context);
        }

        return $output;
    }

    /**
     * @param  AiContextDto  $dto
     * @return array
     */
    protected function createContextArray(AiContextDto $dto): array
    {
        return [
            'role' => $dto->role->value,
            'content' => $dto->content
        ];
    }
}
