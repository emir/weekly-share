<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class LinksControllerTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @test
     */
    public function itReturnsHttpCreatedCodeIfGivenUrlAndEmailAreValid()
    {
        $response = $this->json('POST', '/api/v1/links', [
            'url' => 'https://google.com',
            'email' => 'test@test.com'
        ]);

        $response->assertStatus(201);
    }

    public function itReturnsHttpUnprocessableEntityCodeIfEmailNotPresent()
    {
        $response = $this->json('POST', '/api/v1/links', [
            'url' => 'https://google.com',
        ]);

        $expectedJson = '{"message":"The given data was invalid.","errors":{"email":["The email field is required."]}}';

        $response->assertStatus(422)
            ->assertExactJson(json_decode($expectedJson, true));
    }

    public function itReturnsHttpUnprocessableEntityCodeIfUrlNotPresent()
    {
        $response = $this->json('POST', '/api/v1/links', [
            'email' => 'test@test.com',
        ]);

        $expectedJson = '{"message":"The given data was invalid.","errors":{"url":["The url field is required."]}}';

        $response->assertStatus(422)
            ->assertExactJson(json_decode($expectedJson, true));
    }

    public function itReturnsHttpUnprocessableEntityCodeIfEmailAndUrlNotPresent()
    {
        $response = $this->json('POST', '/api/v1/links', []);

        $expectedJson = '{"message":"The given data was invalid.","errors":{"url":["The url field is required."], "email":["The email field is required."]}}';

        $response->assertStatus(422)
            ->assertExactJson(json_decode($expectedJson, true));
    }
}
