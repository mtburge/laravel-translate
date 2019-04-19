<?php

namespace itsmattburgess\LaravelTranslate\Tests;

use Orchestra\Testbench\TestCase;
use Illuminate\Filesystem\Filesystem;
use itsmattburgess\LaravelTranslate\Publisher;

class PublisherTest extends TestCase
{
    /**
     * @test
     */
    public function it_should_create_the_lang_file_if_it_doesnt_exist()
    {
        $diskMock = \Mockery::mock(Filesystem::class);
        $diskMock->shouldReceive('isDirectory')->once();
        $diskMock->shouldReceive('makeDirectory')->once();
        $diskMock->shouldReceive('exists')->andReturnFalse();
        $diskMock->shouldReceive('put')->twice();
        $diskMock->shouldReceive('get')->once()->andReturn('{}');

        $publisher = new Publisher($diskMock);

        $publisher->publish('Hello :name', 'Bonjour :name', 'fr');
    }

    /**
     * @test
     */
    public function it_should_add_a_new_translation_to_an_existing_file()
    {
        $diskMock = \Mockery::mock(Filesystem::class);
        $diskMock->shouldReceive('isDirectory')->once();
        $diskMock->shouldReceive('makeDirectory')->once();
        $diskMock->shouldReceive('exists')->andReturnTrue();
        $diskMock->shouldReceive('put')->once();
        $diskMock->shouldReceive('get')->once()->andReturn('{}');

        $publisher = new Publisher($diskMock);

        $publisher->publish('Hello :name', 'Bonjour :name', 'fr');
    }
}
