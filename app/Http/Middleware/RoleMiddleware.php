<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $role): mixed
    {
        if (!auth()->check()) {
            return redirect('/login');
        }

        if (auth()->user()->role !== $role) {
            if (auth()->user()->role === 'admin') {
            // Cegah loop kalau sudah di halaman admin
                if ($request->is('admin/*') || $request->is('admin')) {
                    abort(403);
                }
                return redirect('/admin/dashboard');
            }

            // Cegah loop kalau sudah di halaman user
            if ($request->is('dashboard')) {
                abort(403);
            }
            return redirect('/dashboard');
        }

        return $next($request);
    }
}