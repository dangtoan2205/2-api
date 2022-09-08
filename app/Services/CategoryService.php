<?php

namespace App\Services;

use App\Repositories\Category\CategoryRepositoryInterface;

class CategoryService extends BaseService
{
    public function getRepository()
    {
        return CategoryRepositoryInterface::class;
    }
}
