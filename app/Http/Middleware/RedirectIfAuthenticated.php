<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Jika user sudah login, redirect ke dashboard atau halaman lain
        if (Auth::check()) {
            return redirect('/'); // Ubah ke halaman sesuai kebutuhan
        }

        return $next($request);
    }
}