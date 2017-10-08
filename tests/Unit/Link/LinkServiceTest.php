<?php

namespace Tests\Unit\Link;

use App\Link;
use App\Link\LinkService;
use App\Link\Repositories\LinkRepository;
use Illuminate\Contracts\Logging\Log;
use Tests\TestCase;

class LinkServiceTest extends TestCase
{
    public $linkRepository;

    public $log;

    public $linkService;

    public function __construct()
    {
        parent::__construct();

        $this->linkRepository = \Mockery::mock(LinkRepository::class);

        $this->log = \Mockery::mock(Log::class);

        $this->linkService = new LinkService(
            $this->linkRepository, $this->log
        );
    }

    /**
     * @test
     */
    public function serviceSuccessfullyCreatedWithActualDependencies()
    {
        $linkService = new LinkService(
            new Link\Repositories\EloquentLinkRepository(
                new Link(),
                app()->make(Log::class)
            ),
            app()->make(Log::class)
        );

        $this->assertInstanceOf(LinkService::class, $linkService);
    }


    /**
     * @test
     */
    public function saveShouldReturnFalseWithInvalidUrlParam()
    {
        $this->log->shouldReceive('error')->andReturn();

        $this->assertFalse($this->linkService->save('google', 'test@test.com'));
    }

    /**
     * @test
     */
    public function saveShouldReturnFalseWithInvalidEmailParam()
    {
        $this->log->shouldReceive('error')->andReturn();

        $this->assertFalse($this->linkService->save('https://google.com', 'test'));
    }

    /**
     * @test
     */
    public function saveShouldReturnTrueWithValidUrlAndEmailParams()
    {
        $this->linkRepository->shouldReceive('create')->andReturn(true);

        $this->assertTrue($this->linkService->save('https://google.com', 'test@test.com'));
    }
}
