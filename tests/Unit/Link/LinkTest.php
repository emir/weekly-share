<?php

namespace Tests\Unit\Link;

use App\Link\Link;
use App\Link\ValueObjects\Email;
use App\Link\ValueObjects\Url;
use Tests\TestCase;

class LinkTest extends TestCase
{
    /**
     * @test
     */
    public function createdSuccessfullyWithValidUrlAndEmailValueObjects()
    {
        $link = new Link(
            new Url('https://google.com'),
            new Email('test@test.com')
        );

        $this->assertEquals('test@test.com', $link->getEmail());
        $this->assertEquals('https://google.com', $link->getUrl());
    }
}
