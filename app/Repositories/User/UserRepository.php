<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\BaseRepository;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function getModel()
    {
        return User::class;
    }
    public function register($request)
    {
        $user = new $this->model;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->title = null;
        $user->gender = null;
        $user->avatar_url = null;
        $user->education = null;
        $user->location = null;
        $user->skills = null;
        $user->note = null;
        $user->birthday = null;
        $user->is_active = null;
        $user->roles = null;
        $user->save();
        return $user;
    }
}
