<?php

namespace Tests\Unit\Link\ValueObjects;

use App\Link\ValueObjects\Email;
use Tests\TestCase;

class EmailTest extends TestCase
{
    /**
     * @test
     * @expectedException \App\Link\Exceptions\InvalidEmailException
     * @expectedExceptionMessage Invalid email address
     */
    public function throwsAnExceptionWithInvalidEmailAddress()
    {
        new Email('test');
    }

    /**
     * @test
     */
    public function successfullyCreatedWithValidEmailAddress()
    {
        $email = new Email('test@test.com');

        $this->assertEquals('test@test.com', (string)$email);
    }
}
