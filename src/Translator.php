<?php

namespace itsmattburgess\LaravelTranslate;

use itsmattburgess\LaravelTranslate\Contracts\TranslationService;

class Translator
{
    /**
     * @var TranslationService
     */
    private $service;

    /**
     * @param TranslationService $service
     */
    public function __construct(TranslationService $service)
    {
        $this->service = $service;
    }

    /**
     * Translate the given string to the specified language.
     *
     * @param string $text
     * @param string $target
     * @return string|null
     */
    public function translate(string $text, string $target): ?string
    {
        $translated = '';

        /**
         * The text is split into segments so that any parameters are not translated.
         */
        $segments = preg_split('/(:[\w\d\s]+)/imu', $text, 0, PREG_SPLIT_DELIM_CAPTURE);

        foreach ($segments as $segment) {
            /**
             * If a parameter is found, we go ahead and add that to the string
             * and continue so that it is not translated.
             */
            if (substr($segment, 0, 1) === ':') {
                $translated .= $segment;
                continue;
            }

            $translated .= $this->service->translate(trim($segment), $target) . ' ';
        }

        return trim($translated);
    }

    /**
     * Returns the service bound at provider registration.
     *
     * @return TranslationService
     */
    public function getService()
    {
        return $this->service;
    }
}
