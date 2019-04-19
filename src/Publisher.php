<?php

namespace itsmattburgess\LaravelTranslate;

use Illuminate\Filesystem\Filesystem;

class Publisher
{
    private $disk;

    public function __construct(Filesystem $disk)
    {
        $this->disk = $disk;
    }

    public function publish($original, $translated, $lang)
    {
        $path = resource_path('lang/' . $lang . '.json');

        $this->prepareFilesystem($path);

        $currentTranslations = json_decode($this->disk->get($path), true);

        $currentTranslations[html_entity_decode($original, ENT_QUOTES)] = html_entity_decode($translated, ENT_QUOTES);

        $this->disk->put($path, json_encode($currentTranslations, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT));
    }

    private function prepareFilesystem($path): void
    {
        // Create the directory if it doesn't exist
        if (! $this->disk->isDirectory(resource_path('lang/'))) {
            $this->disk->makeDirectory(resource_path('lang/'));
        }

        // Create the translation definition if it doesn't exist
        if (! $this->disk->exists($path)) {
            $this->disk->put($path, '{}');
        }
    }
}
