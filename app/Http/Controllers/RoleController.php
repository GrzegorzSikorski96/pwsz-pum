<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Services\RoleService;
use Illuminate\Http\JsonResponse;

class RoleController extends Controller
{
    protected $roleService;

    public function __construct(ApiResponse $apiResponse, RoleService $roleService)
    {
        parent::__construct($apiResponse);
        $this->roleService = $roleService;
    }

    public function roles(): JsonResponse
    {
        $roles = $this->roleService->roles();

        return $this->apiResponse
            ->setData([
                'roles' => $roles,
            ])
            ->setSuccessStatus()
            ->getResponse();
    }

    public function changeRole($userId, $roleId): JsonResponse
    {
        $roles = $this->roleService->changeRole($userId, $roleId);

        return $this->apiResponse
            ->setMessage('Zmieniono rolę użytkownika')
            ->setSuccessStatus()
            ->getResponse();
    }
}
