<?php

namespace App\Services;

use App\Repositories\Tag\TagRepositoryInterface;

class TagService extends BaseService
{
    public function getRepository()
    {
        return TagRepositoryInterface::class;
    }
}
