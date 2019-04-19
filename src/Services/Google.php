<?php

namespace itsmattburgess\LaravelTranslate\Services;

use itsmattburgess\LaravelTranslate\Contracts\TranslationService;

class Google implements TranslationService
{
    public function translate(string $text, string $target): ?string
    {
        return null;
        // TODO: Implement translate() method.
    }
}
