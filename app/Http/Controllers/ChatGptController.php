<?php

namespace App\Http\Controllers;

use App\Services\ChatGPT\ChatGptService;

class ChatGptController extends Controller
{
    public function getInfo()
    {
        $service = new ChatGptService();
        $service->get('как звали первого космонавта?');
    }
}
