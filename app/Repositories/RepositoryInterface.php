<?php

namespace App\Repositories;

interface RepositoryInterface
{
    public function getAll($paginate);

    public function find($id);

    public function store($attributes = []);

    public function update($id, $attributes = []);

    public function delete($id);
}
