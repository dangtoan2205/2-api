<?php

namespace App\Repositories;

use App\Repositories\RepositoryInterface;

abstract class BaseRepository implements RepositoryInterface
{
    protected $model;

    public function __construct()
    {
        $this->setModel();
    }

    abstract public function getModel();

    public function setModel()
    {
        $this->model = app()->make($this->getModel());
    }
    // method
    public function getAll($paginate = false)
    {
        if ($paginate) {
//            return $this->model->latest()->paginate(10);
            return $this->model->orderBy('id')->paginate(10);
        }
        return $this->model->all();
    }

    public function find($id)
    {
        $result = $this->model->findOrFail($id);
        return $result;
    }

    public function store($attributes = [])
    {
        return $this->model->create($attributes);
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
