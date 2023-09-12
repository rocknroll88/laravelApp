<?php

declare(strict_types=1);

namespace App\Telegram;

use DefStudio\Telegraph\Handlers\WebhookHandler;
use DefStudio\Telegraph\Facades\Telegraph;
use DefStudio\Telegraph\Keyboard\Keyboard;
use DefStudio\Telegraph\Keyboard\Button;
use Illuminate\Support\Stringable;
use App\Services\ChatGPT\ChatGptService;

class TelegramHandler extends WebhookHandler
{
    /**
     * @var ChatGptService
     */
    protected ChatGptService $chatService;

    public function __construct()
    {
        $this->chatService = new ChatGptService();
        parent::__construct();
    }

    public function start()
    {
        Telegraph::message('hello world')
            ->keyboard(Keyboard::make()->buttons([
                Button::make("👀 new")->action("new"),
                Button::make("👀 settings")->action("settings"),
                Button::make("👀 mode")->action("mode"),
                Button::make("👀 balance")->action("balance"),
            ]))->send();
    }

    public function help()
    {
        $this->reply('Этот бот умееет принимаить оплату!');
    }

    protected function handleChatMessage(Stringable $text): void
    {
        $message = $text->value();
        $answer = $this->chatService->get($message);

        $this->reply($answer);
    }
}
