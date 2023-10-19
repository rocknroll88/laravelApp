<?php

declare(strict_types=1);

namespace App\Services\AI\DTO;

use App\Services\AI\Enum\AiContextRole;

class AiCommandDto
{
    /**
     * @param  string        $prompt
     * @param  string        $identity
     * @param  AiContextRole[]  $context
     */
    public function __construct(
        public readonly string $prompt,
        public readonly string $identity,
        public readonly array $context = []
    )
    {
    }

}
