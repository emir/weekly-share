<?php

namespace Tests\Unit\Link\ValueObjects;

use App\Link\ValueObjects\Url;
use Tests\TestCase;

class UrlTest extends TestCase
{
    /**
     * @test
     * @expectedException \App\Link\Exceptions\InvalidUrlException
     * @expectedExceptionMessage The specified URL is invalid
     */
    public function throwsAnExceptionWithInvalidUrl()
    {
        new Url('test');
    }

    /**
     * @test
     */
    public function successfullyCreatedWithValidUrl()
    {
        $url = new Url('https://google.com');

        $this->assertEquals('https://google.com', (string)$url);
    }
}
