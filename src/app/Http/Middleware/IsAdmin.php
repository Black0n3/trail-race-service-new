<?php

namespace App\Http\Middleware;

use App\Enums\UserRoleEnum;

use Closure;
use Illuminate\Http\Request;


class IsAdmin
{
    public function handle($request, Closure $next)
    {
        if (!$request->user()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Check is user role is ADMIN
        if ($request->user()->role != UserRoleEnum::ADMIN) {
            return response()->json(['error' => 'Unauthorized - Only administrators have access.'], 403);
        }

        return $next($request);
    }
}
