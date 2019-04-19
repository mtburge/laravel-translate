<?php

namespace itsmattburgess\LaravelTranslate\Contracts;

interface TranslationService
{
    /**
     * Translate the given string using the translation service.
     *
     * @param string $text
     * @param string $target
     * @return string|null
     */
    public function translate(string $text, string $target): ?string;
}
