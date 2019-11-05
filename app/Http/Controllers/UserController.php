<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Requests\User;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;

    public function __construct(ApiResponse $apiResponse, UserService $userService)
    {
        parent::__construct($apiResponse);
        $this->userService = $userService;
    }

    public function create(User $data): JsonResponse
    {
        $this->userService->create($data->all());

        return $this->apiResponse
            ->setMessage(__('messages.user.create.success'))
            ->setSuccessStatus()
            ->getResponse();
    }

    public function user(int $userId): JsonResponse
    {
        $user = $this->userService->user($userId);

        return $this->apiResponse
            ->setData([
                'user' => $user,
            ])
            ->setSuccessStatus()
            ->getResponse();
    }

    public function users(): JsonResponse
    {
        $users = $this->userService->users();

        return $this->apiResponse
            ->setData([
                'users' => $users,
            ])
            ->setSuccessStatus()
            ->getResponse();
    }

    public function edit(User $data, int $userId): JsonResponse
    {
        $edited = $this->userService->edit($data->all(), $userId);

        return $this->apiResponse
            ->setData([
                'user' => $edited,
            ])
            ->setSuccessStatus()
            ->getResponse();
    }

    public function changePassword(Request $request, $userId)
    {
        $this->userService->changePassword($request->password, $userId);

        return $this->apiResponse
            ->setMessage('Hasło zmienione.')
            ->setSuccessStatus()
            ->getResponse();
    }

    public function remove(int $userId): JsonResponse
    {
        $this->userService->remove($userId);

        return $this->apiResponse
            ->setMessage('Removed')
            ->setSuccessStatus()
            ->getResponse();
    }
}
