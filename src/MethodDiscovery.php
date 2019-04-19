<?php

namespace itsmattburgess\LaravelTranslate;

use Illuminate\Filesystem\Filesystem;

class MethodDiscovery
{
    /**
     * @var Filesystem
     */
    private $disk;

    /**
     * @var array
     */
    private $paths;

    /**
     * @var array
     */
    private $methods;

    /**
     * @param Filesystem $disk
     * @param array $paths
     * @param array $methods
     */
    public function __construct(Filesystem $disk, array $paths, array $methods)
    {
        $this->disk = $disk;
        $this->paths = $paths;
        $this->methods = $methods;
    }

    /**
     * Returns all the translation strings discovered in the paths specified.
     *
     * @return array
     */
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

    /**
     * Returns the regex string to detect translation methods in the specified paths.
     *
     * @return string
     */
    private function regex()
    {
        return '(trans|__)'
            . '\([\'"]'
            . '([\w\d\s\t\n\r,.\'\":\\\?!@£$%^&*<>_\-=\|\+]+)'
            . '[\'\"](\)'
            . '|(,\s*)'
            . '(\[.+\])\))';
    }
}
