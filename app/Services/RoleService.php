<?php

namespace App\Services;

use App\Models\Role;
use Illuminate\Database\Eloquent\Collection;

class RoleService
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function roles(): Collection
    {
        return Role::all();
    }

    public function role($roleId)
    {
        return Role::findOrFail($roleId);
    }

    public function changeRole($userId, $roleId): Collection
    {
        $role = $this->role($roleId);
        $user = $this->userService->user($userId);

        $user->role_id = $role->id;
        $user->save();

        return Role::all();
    }
}
