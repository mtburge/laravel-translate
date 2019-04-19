<?php

namespace itsmattburgess\LaravelTranslate\Tests;

use Orchestra\Testbench\TestCase;
use itsmattburgess\LaravelTranslate\MethodDiscovery;
use itsmattburgess\LaravelTranslate\TranslationServiceProvider;

class MethodDiscoveryTest extends TestCase
{
    private $discovery;

    protected function setUp(): void
    {
        parent::setUp();

        $this->discovery = app()->make(MethodDiscovery::class);
    }

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
    public function it_should_detect_trans_methods()
    {
        $this->assertContains('trans', $this->discovery->discover());
        $this->assertContains('twice', $this->discovery->discover());
    }

    /**
     * @test
     */
    public function it_should_detect_double_underscore_methods()
    {
        $this->assertContains('You\'re seeing an underscore', $this->discovery->discover());
    }

    /**
     * @test
     */
    public function it_should_detect_methods_with_parameters()
    {
        $this->assertContains('parameter :name', $this->discovery->discover());
    }
}
