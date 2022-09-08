<?php

namespace App\Services;

abstract class BaseService
{
    protected $repository;

    public function __construct()
    {
        $this->setRepository();
    }

    abstract public function getRepository();

    public function setRepository()
    {
        $this->repository = app()->make(
            $this->getRepository()
        );
    }
    public function getAll($paginate = false)
    {
        return $this->repository->getAll($paginate);
    }

    public function find($id)
    {
        $result = $this->repository->find($id);
        return $result;
    }

    public function store($attributes = [])
    {
        return $this->repository->store($attributes);
    }

    public function update($id, $attributes = [])
    {
        $result = $this->find($id);
        if ($result) {
            $result->update($attributes);
            return $result;
        }
        return false;
    }

    public function delete($id)
    {
        $result = $this->find($id);
        if ($result) {
            $result->delete();
            return true;
        }
        return false;
    }
}
