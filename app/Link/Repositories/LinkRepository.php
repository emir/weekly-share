<?php

namespace App\Link\Repositories;

use App\Link\Link;

interface LinkRepository
{
    public function create(Link $link): bool;
}