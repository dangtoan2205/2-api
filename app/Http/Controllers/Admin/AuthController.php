<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5|max:20'
        ]);
        $result =  $this->userService->register($request);
        return response()->json([
            'result' => $result,
            'msg' => 'Đăng kí thành công'
        ], 200);
    }
    public function login(LoginRequest $request)
    {
        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ])) {
            $user = Auth::user();
            $token = $user->createToken('AccessToken')->accessToken;
            return response()->json([
                'user' => $user,
                'token' => $token
            ], 200);
        }
        return response()->json([
            'msg' => 'Email hoặc mật khẩu không đúng'
        ], 404);
    }
    public function getUser(Request $request)
    {
        return response()->json($request->user('api'));
    }
    public function logout()
    {
        if (Auth::check()) {
            Auth::user()->token()->revoke();
            return response()->json(['success' => 'logout_success'], 200);
        } else {
            return response()->json(['error' => 'something_went_wrong'], 500);
        }
    }
}
