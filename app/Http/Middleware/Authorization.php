<?php

namespace App\Http\Middleware;

use App\Models\Role;
use App\Models\UserRole;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Authorization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->user()) {
            return redirect()->route('home');
        }

        $user_role = UserRole::query()->where('user_id', auth()->user()->id)->first();

        $role_id = $user_role ? $user_role->role_id : null;

        $role = Role::query()->where('id', $role_id)->first();

        if (!$role || $role->name !== 'admin') {
            return redirect()->route('home');
        }

        return $next($request);
    }
}
