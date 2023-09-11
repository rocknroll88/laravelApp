<?php

namespace App\Http;

interface TitleTemplate
{
    public function getTemplateString(): string;
}