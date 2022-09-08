<?php

namespace App\Services;


use App\Repositories\User\UserRepositoryInterface;
use App\Services\BaseService;
use Illuminate\Support\Facades\Auth;

class UserService extends BaseService
{
    public function getRepository()
    {
        return UserRepositoryInterface::class;
    }
    public function register($request)
    {
        $result = $this->repository->register($request);
        return $result;
    }
    public function getCurrentId()
    {
        return Auth::user()->id;
    }
}
