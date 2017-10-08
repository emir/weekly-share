<?php

namespace Tests\Unit\Link\Repositories;

use App\Link\Link;
use App\Link\Repositories\EloquentLinkRepository;
use Illuminate\Contracts\Logging\Log;
use Illuminate\Database\Eloquent\Model;
use Tests\TestCase;

class EloquentLinkRepositoryTest extends TestCase
{
    public $model;

    public $log;

    public $linkRepository;

    public function __construct()
    {
        parent::__construct();

        $this->model = \Mockery::mock(Model::class);

        $this->log = \Mockery::mock(Log::class);

        $this->linkRepository = new EloquentLinkRepository(
            $this->model, $this->log
        );
    }

    /**
     * @test
     */
    public function returnTrueIfWasRecentlyCreatedReturnTrue()
    {
        $linkDouble = new \stdClass();
        $linkDouble->wasRecentlyCreated = true;

        $this->model->shouldReceive('create')->andReturn($linkDouble);

        $link = \Mockery::mock(Link::class);

        $link->shouldReceive('getUrl')->andReturn('https://google.com');
        $link->shouldReceive('getEmail')->andReturn('test@test.com');

        $this->assertEquals(true, $this->linkRepository->create($link));
    }

    /**
     * @test
     */
    public function returnFalseIfWasRecentlyCreatedReturnFalse()
    {
        $linkDouble = new \stdClass();
        $linkDouble->wasRecentlyCreated = false;

        $this->model->shouldReceive('create')->andReturn($linkDouble);

        $link = \Mockery::mock(Link::class);

        $link->shouldReceive('getUrl')->andReturn('https://google.com');
        $link->shouldReceive('getEmail')->andReturn('test@test.com');

        $this->assertEquals(false, $this->linkRepository->create($link));
    }

    /**
     * @test
     */
    public function returnFalseIfEloquentThrowPDOException()
    {
        $this->model->shouldReceive('create')->andThrow(\PDOException::class);

        $link = \Mockery::mock(Link::class);

        $link->shouldReceive('getUrl')->andReturn('https://google.com');
        $link->shouldReceive('getEmail')->andReturn('test@test.com');

        $this->log->shouldReceive('alert')->andReturn(true);

        $this->assertEquals(false, $this->linkRepository->create($link));
    }
}
