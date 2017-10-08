<?php

namespace App\Link\Repositories;

use App\Link\Link;
use Illuminate\Contracts\Logging\Log;
use Illuminate\Database\Eloquent\Model;

class EloquentLinkRepository implements LinkRepository
{
    /**
     * @var Model
     */
    private $model;

    /**
     * @var Log
     */
    private $log;

    /**
     * @param Model $model
     * @param Log $log
     */
    public function __construct(Model $model, Log $log)
    {
        $this->model = $model;
        $this->log = $log;
    }

    /**
     * @param Link $link
     * @return bool
     */
    public function create(Link $link): bool
    {
        try {
            $link = $this->model->create([
                'url' => $link->getUrl(),
                'email' => $link->getEmail()
            ]);
        } catch (\PDOException $PDOException) {
            $this->log->alert('We faced an error while creating a new link.', $PDOException->getTrace());

            return false;
        }

        if (false === $link->wasRecentlyCreated) {
            return false;
        }

        return true;
    }
}