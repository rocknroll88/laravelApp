<?php

declare(strict_types=1);

namespace App\Services\AI\DTO;

class AiResultDto
{
    public function __construct(
        public readonly string $output,
        public readonly int $tokens
    )
    {

    }
}
