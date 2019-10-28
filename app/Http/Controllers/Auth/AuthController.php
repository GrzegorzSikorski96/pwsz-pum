<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Requests\Login;
use App\Models\User;
use App\Services\TokenService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected $tokenService;

    public function __construct(ApiResponse $apiResponse, TokenService $tokenService)
    {
        parent::__construct($apiResponse);
        $this->tokenService = $tokenService;
    }

    public function login(Login $request): JsonResponse
    {
        if (!$token = auth()->attempt($request->only(['email', 'password',]))) {
            return $this->apiResponse
                ->setMessage(__('messages.login.fail'))
                ->setFailureStatus(400)
                ->getResponse();
        }

        $user = User::with('role')->find(Auth::id());

        return $this->apiResponse
            ->setMessage(__('messages.login.success'))
            ->setData([
                'token' => $token,
                'user' => $user,
            ])
            ->setSuccessStatus()
            ->getResponse();
    }

    public function logout(): JsonResponse
    {
        auth()->logout();

        return $this->apiResponse
            ->setMessage(__('messages.logout.success'))
            ->setSuccessStatus()
            ->getResponse();
    }

    public function refresh(): JsonResponse
    {
        return $this->apiResponse
            ->setData([
                'token' => auth()->refresh(),
            ])
            ->setSuccessStatus()
            ->getResponse();
    }
}
