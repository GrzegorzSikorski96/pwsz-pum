<?php

namespace App\Services;

use App\Models\User;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\JWTAuth;

class TokenService
{
    public function generateToken(User $user): string
    {
        return JWTAuth::fromUser($user);
    }

    /**
     * @throws JWTException
     */
    public function deactivateToken(): void
    {
        JWTAuth::parseToken()->invalidate();
    }
}
