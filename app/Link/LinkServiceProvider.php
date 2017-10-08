<?php

namespace App\Link;

use App\Link;
use App\Link\Repositories\EloquentLinkRepository;
use App\Link\Repositories\LinkRepository;
use Illuminate\Log\Writer;
use Illuminate\Support\ServiceProvider;

/**
 * @codeCoverageIgnore
 */
class LinkServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(LinkRepository::class, function () {
            return new EloquentLinkRepository(
                new Link(),
                app(Writer::class)
            );
        });
    }
}
