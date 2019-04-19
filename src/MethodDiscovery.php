<?php

namespace itsmattburgess\LaravelTranslate;

use Illuminate\Filesystem\Filesystem;

class MethodDiscovery
{
    private $disk;

    private $paths;

    private $methods;

    public function __construct(Filesystem $disk, array $paths, array $methods)
    {
        $this->disk = $disk;
        $this->paths = $paths;
        $this->methods = $methods;
    }

    public function discover(): array
    {
        $strings = [];

        foreach ($this->disk->allFiles($this->paths) as $file) {
            if (preg_match_all('/' . $this->regex() . '/imu', $file->getContents(), $matches)) {
                foreach ($matches[2] as $match) {
                    $strings[] = trim(stripcslashes($match));
                }
            }
        }

        return $strings;
    }

    private function regex()
    {
        //return (trans|__)\(['"]([\w\d\s\t\n\r,.\'\\":]+)['"](\)|(,\s*)(\[.+\])\));

        return '(trans|__)'
            . '\([\'"]'
            . '([\w\d\s\t\n\r,.\'\":\\\]+)'
            . '[\'\"](\)'
            . '|(,\s*)'
            . '(\[.+\])\))';
    }
}
