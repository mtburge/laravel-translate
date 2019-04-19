<?php

namespace itsmattburgess\LaravelTranslate\Services;

use Google\Cloud\Translate\TranslateClient;
use itsmattburgess\LaravelTranslate\Contracts\TranslationService;

class Google implements TranslationService
{
    private $google;

    public function __construct(TranslateClient $google)
    {
        $this->google = $google;
    }

    /**
     * Translate a string using the Google Cloud Translate API.
     *
     * @param string $text
     * @param string $target
     * @return string|null
     */
    public function translate(string $text, string $target): ?string
    {
        $translation = $this->google->translate($text, [
            'target' => $target,
        ]);

        return $translation['text'];
    }
}
