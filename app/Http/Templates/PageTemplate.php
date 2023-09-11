<?php

namespace App\Http;

interface PageTemplate
{
    public function getTemplateString(): string;
}