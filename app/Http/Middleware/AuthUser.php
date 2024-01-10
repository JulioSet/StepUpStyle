<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if (session('ownerLoggedIn')) {
            return redirect()->back()->with('message', 'Anda tidak memiliki izin untuk mengakses halaman ini.');
        }
        if (session('adminLoggedIn')) {
            return redirect()->back()->with('message', 'Anda tidak memiliki izin untuk mengakses halaman ini.');
        }
        
        if (!session('userLoggedIn')) {
            return redirect('/login')->with('message', 'Anda tidak memiliki izin untuk mengakses halaman ini.');
        }
        
        return $next($request);
        
        
        
    }
}
