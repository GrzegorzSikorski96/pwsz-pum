<?php

namespace App\Http\Middleware\Roles;

use App\Models\Role;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\UnauthorizedException;

class User
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $available = [
            Role::ADMINISTRATOR,
            Role::USER,
        ];

        if (in_array(Auth::user()->role->id, $available)) {
            return $next($request);
        }

        throw new UnauthorizedException();
    }
}
