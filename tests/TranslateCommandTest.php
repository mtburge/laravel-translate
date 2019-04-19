<?php

namespace itsmattburgess\LaravelTranslate\Tests;

use Orchestra\Testbench\TestCase;
use itsmattburgess\LaravelTranslate\TranslationServiceProvider;
use itsmattburgess\LaravelTranslate\Contracts\TranslationService;

class TranslateCommandTest extends TestCase
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
            'fr',
        ]);
    }

    /**
     * @test
     */
    public function it_should_translate_and_publish_strings()
    {
        $translationMock = \Mockery::mock(TranslationService::class);
        $translationMock->shouldReceive('translate')->andReturn('translated');

        $this->app->singleton(TranslationService::class, function () use ($translationMock) {
            return $translationMock;
        });

        $this->artisan('translate')
            ->assertExitCode(0);
    }
}
