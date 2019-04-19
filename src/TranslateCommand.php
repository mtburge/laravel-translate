<?php

namespace itsmattburgess\LaravelTranslate;

use Illuminate\Console\Command;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use itsmattburgess\LaravelTranslate\Exceptions\InvalidLanguageCode;

class TranslateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'translate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Translates your application into the specified languages in config/translate.php';

    /**
     * Execute the console command.
     *
     * @param MethodDiscovery $discovery
     * @param Translator $translator
     * @param Publisher $publisher
     * @return mixed
     * @throws InvalidLanguageCode
     * @throws FileNotFoundException
     */
    public function handle(MethodDiscovery $discovery, Translator $translator, Publisher $publisher)
    {
        $requireTranslation = $discovery->discover();
        $languages = config('translate.targetLanguages');

        $this->validateLanguageCodes($languages);

        $this->info('Translating ' . config('app.name') . ' into ' . count($languages) . ' languages (' . implode(', ', $languages) . ')');

        $bar = $this->output->createProgressBar(count($requireTranslation) * count($languages));

        $bar->start();

        foreach ($languages as $language) {
            foreach ($requireTranslation as $text) {
                $translated = $translator->translate($text, $language);
                $publisher->publish($text, $translated, $language);
                $bar->advance();
            }
        }

        $bar->finish();

        $this->line('');
        $this->line('');
        $this->info('Your translation files have been updated successfully.');
    }

    /**
     * Validates all target languages are valid ISO639-1 codes.
     *
     * @param $codes
     * @throws InvalidLanguageCode
     */
    private function validateLanguageCodes($codes)
    {
        foreach ($codes as $language) {
            if (! LanguageValidator::isValid($language)) {
                throw new InvalidLanguageCode($language);
            }
        }
    }
}
