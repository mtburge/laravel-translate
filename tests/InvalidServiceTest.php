<?php

namespace itsmattburgess\LaravelTranslate\Tests;

use itsmattburgess\LaravelTranslate\Exceptions\InvalidServiceException;
use itsmattburgess\LaravelTranslate\Services\Google;
use Orchestra\Testbench\TestCase;
use itsmattburgess\LaravelTranslate\Translator;
use itsmattburgess\LaravelTranslate\TranslationServiceProvider;
use itsmattburgess\LaravelTranslate\Contracts\TranslationService;

class InvalidServiceTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [TranslationServiceProvider::class];
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('translate.driver', 'invalid');
        $app['config']->set('translate.paths', [__DIR__ . '/stubs']);
        $app['config']->set('translate.methods', [
            'trans',
            '__'
        ]);
    }

    /**
     * @test
     */
    public function it_should_throw_an_exception_if_an_invalid_service_is_defined()
    {
        $this->expectException(InvalidServiceException::class);

        $service = app()->make(Translator::class);
    }
}
