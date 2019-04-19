<?php

namespace itsmattburgess\LaravelTranslate\Services;

use Google\Cloud\Translate\TranslateClient;
use itsmattburgess\LaravelTranslate\Contracts\TranslationService;

class Google implements TranslationService
{
    public function translate(string $text, string $target): ?string
    {
        $translate = new TranslateClient(config('translate.services.google'));

        $translation = $translate->translate($text, [
            'target' => $target,
        ]);

        return $translation['text'];
    }
}
