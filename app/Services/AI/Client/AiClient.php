<?php

declare(strict_types=1);

namespace App\Services\AI\Client;

use App\Services\AI\DTO\AiCommandDto;
use App\Services\AI\DTO\AiResultDto;

interface AiClient
{
    public function generate(AiCommandDto $dto): AiResultDto;

}
