<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle($request, Closure $next)
{
    #BELUM LOGIN

    if(!session()->has('user_id'))
    {
        return redirect('/login');
    }
    # BELUM ADMIN
    if(!session('is_admin'))
    {
        return redirect('/');
    }

    return $next($request);
}
}