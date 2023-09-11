<?php

namespace App\Http;

class TwigRenderer implements TemplateRenderer
{
    public function render(string $templateString, array $arguments = []): string
    {
        // return \Twig::render($templateString, $arguments);
        return 'test';
    }
}