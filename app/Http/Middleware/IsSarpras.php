<?php

namespace App\Http\Middleware;

use Closure;

class IsSarpras
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
        if (auth()->check() && $request->user()->role == 'sarpras'){
            return $next($request);
        } elseif (auth()->check() && $request->user()->role == 'tu'){
            return redirect()->guest('/tu/index');
        } elseif (auth()->check() && $request->user()->role == 'admin'){
            return redirect()->guest('/admin/index');
        } else {
            return redirect()->guest('/superadmin/index');
        }
    }
}
