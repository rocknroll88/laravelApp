<?php

declare(strict_types=1);

namespace App\Services\AI\Enum;

enum AiContextRole: string
{
    case User = 'user';
    case Assistant = 'assistant';
    case System = 'system';
}
