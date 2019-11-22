<?php

namespace App\Services;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\UnauthorizedException;

class UserService
{
    public function create(array $request): User
    {
        return User::create([
            'name' => $request['name'],
            'surname' => $request['surname'],
            'email' => $request['email'],
            'password' => $this->hashPassword($request['password']),
            'role_id' => $request['role_id']]);
    }

    public function hashPassword(string $password): string
    {
        return Hash::make($password);
    }

    public function user(int $userId): Model
    {
        return User::with(['role'])->findOrFail($userId);
    }

    public function users(): Collection
    {
        return User::all();
    }

    public function changePassword(string $password, int $userId)
    {
        $user = $this->user($userId);

        if ($user->id == Auth::id() || Auth::user()->role_id == Role::ADMINISTRATOR) {
            $user->password = $this->hashPassword($password);
            $user->save();
        } else {
            throw new UnauthorizedException();
        }
    }

    public function changeEmail(string $email, int $userId)
    {
        $user = $this->user($userId);

        if ($user->id == Auth::id() || Auth::user()->role_id == Role::ADMINISTRATOR) {
            $user->email = $email;
            $user->save();
        } else {
            throw new UnauthorizedException();
        }
    }

    public function edit(array $data, int $userId): User
    {
        $user = $this->user($userId);

        $user->name = $data['name'];
        $user->surname = $data['surname'];

        if ($user->email != $data['email']) {
            $user->email = $data['email'];
        }
        if ($data['password']) {
            $user->password = $this->hashPassword($data['password']);
        }

        $user->role_id = $data['role_id'];
        $user->save();

        return $user;
    }

    public function remove(int $userId): void
    {
        $user = User::findOrFail($userId);
        $user->delete();
    }
}
