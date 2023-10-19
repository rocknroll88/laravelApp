<?php

declare(strict_types=1);

namespace App\Services\AI\DTO;

use App\Services\AI\Enum\AiContextRole;

class AiContextDto
{
    public function __construct(
        public readonly string $content,
        public readonly AiContextRole $role,
    )
    {

    }

}
