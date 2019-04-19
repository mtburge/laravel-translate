<?php

namespace itsmattburgess\LaravelTranslate;

use itsmattburgess\LaravelTranslate\Contracts\TranslationService;

class Translator
{
    private $service;

    public function __construct(TranslationService $service)
    {
        $this->service = $service;
    }

    public function translate(string $text, string $target): ?string
    {
        $translated = '';
        $segments = preg_split('/(:[\w\d\s]+)/imu', $text, 0, PREG_SPLIT_DELIM_CAPTURE);

        foreach ($segments as $segment) {
            // parameters are not translated, and are simply added back to the string in their original position.
            if (substr($segment, 0, 1) === ':') {
                $translated .= $segment;
                continue;
            }

            // Lets translate
            $translated .= $this->service->translate(trim($segment), $target) . ' ';
        }

        return trim($translated);
    }
}
