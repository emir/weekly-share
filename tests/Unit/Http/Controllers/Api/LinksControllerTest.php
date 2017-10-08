<?php

namespace Tests\Unit\Http\Controllers\Api;

use App\Http\Controllers\Api\LinksController;
use App\Http\Requests\LinkStoreRequest;
use App\Link\LinkService;
use Illuminate\Http\JsonResponse;
use Tests\TestCase;

class LinksControllerTest extends TestCase
{
    /**
     * @test
     */
    public function returnBadRequestCodeWithMessageIfProvidedUrlAndEmailAreWrong()
    {
        $linkService = \Mockery::mock(LinkService::class);

        $linksController = new LinksController($linkService);

        $request = \Mockery::mock(LinkStoreRequest::class);

        $request->shouldReceive('get')->with('url')->andReturn('google');
        $request->shouldReceive('get')->with('email')->andReturn('test');

        $linkService->shouldReceive('save')->andReturn(false);

        $result = $linksController->store($request);

        $this->assertEquals(400, $result->getStatusCode());
        $this->assertJsonStringEqualsJsonString(json_encode(['message' => 'URL couldn\'t saved']), $result->content());
        $this->assertInstanceOf(JsonResponse::class, $result);
    }

    /**
     * @test
     */
    public function returnCreatedCodeIfProvidedUrlAndEmailAreValid()
    {
        $linkService = \Mockery::mock(LinkService::class);

        $linksController = new LinksController($linkService);

        $request = \Mockery::mock(LinkStoreRequest::class);

        $request->shouldReceive('get')->with('url')->andReturn('https://google.com');
        $request->shouldReceive('get')->with('email')->andReturn('test@test.com');

        $linkService->shouldReceive('save')->andReturn(true);

        $result = $linksController->store($request);

        $this->assertEquals(201, $result->getStatusCode());
        $this->assertInstanceOf(JsonResponse::class, $result);
    }
}
