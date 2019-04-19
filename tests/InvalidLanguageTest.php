<?php

namespace itsmattburgess\LaravelTranslate\Tests;

use itsmattburgess\LaravelTranslate\Exceptions\InvalidLanguageCode;
use Orchestra\Testbench\TestCase;
use itsmattburgess\LaravelTranslate\TranslationServiceProvider;
use itsmattburgess\LaravelTranslate\Contracts\TranslationService;

class InvalidLanguageTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [TranslationServiceProvider::class];
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('translate.paths', [__DIR__ . '/stubs']);
        $app['config']->set('translate.methods', [
            'trans',
            '__'
        ]);
        $app['config']->set('translate.targetLanguages', [
            'german',
        ]);
    }

    /**
     * @test
     */
    public function it_should_throw_an_exception_for_invalid_language_codes()
    {
        $this->expectException(InvalidLanguageCode::class);

        $this->artisan('translate')
            ->assertExitCode(0);
    }
}
