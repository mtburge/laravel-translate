<?php

namespace itsmattburgess\LaravelTranslate\Contracts;

interface TranslationService
{
    public function translate(string $text, string $target): ?string;
}
