<?php

namespace itsmattburgess\LaravelTranslate\Tests;

use Orchestra\Testbench\TestCase;
use itsmattburgess\LaravelTranslate\Translator;
use itsmattburgess\LaravelTranslate\Services\Google;
use itsmattburgess\LaravelTranslate\TranslationServiceProvider;

class ServiceTest extends TestCase
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
    }

    /**
     * @test
     */
    public function it_should_bind_the_translator_to_the_service_defined_in_config()
    {
        $service = app()->make(Translator::class);
        $this->assertInstanceOf(Google::class, $service->getService());
    }
}
