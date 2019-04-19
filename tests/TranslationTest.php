<?php

namespace itsmattburgess\LaravelTranslate\Tests;

use itsmattburgess\LaravelTranslate\Contracts\TranslationService;
use itsmattburgess\LaravelTranslate\Translator;
use Orchestra\Testbench\TestCase;
use itsmattburgess\LaravelTranslate\MethodDiscovery;
use itsmattburgess\LaravelTranslate\TranslationServiceProvider;

class TranslationTest extends TestCase
{
    private $discovery;

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
    public function it_should_call_the_translation_service_once_for_text_without_parameters()
    {
        $serviceMock = \Mockery::mock(TranslationService::class);
        $translator = new Translator($serviceMock);

        $serviceMock->shouldReceive('translate')
            ->once()
            ->withArgs(['Hello', 'fr'])
            ->andReturn('Bonjour');

        $translation = $translator->translate('Hello', 'fr');
        $this->assertEquals('Bonjour', $translation);
    }

    /**
     * @test
     */
    public function it_should_call_the_service_three_times_for_text_with_parameters()
    {
        $serviceMock = \Mockery::mock(TranslationService::class);
        $translator = new Translator($serviceMock);

        $serviceMock->shouldReceive('translate')
            ->withArgs(['Hello', 'fr'])
            ->once()
            ->andReturn('Bonjour');

        $serviceMock->shouldReceive('translate')
            ->withArgs(['. How are you?', 'fr'])
            ->once()
            ->andReturn('. Comment vas-tu?');

        $translation = $translator->translate('Hello      :name. How are you?', 'fr');
        $this->assertEquals('Bonjour :name. Comment vas-tu?', $translation);
    }

}
