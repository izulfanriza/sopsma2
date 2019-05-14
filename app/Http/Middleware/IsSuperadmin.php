<?php

namespace App\Http\Middleware;

use Closure;

class IsSuperadmin
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
        if (auth()->check() && $request->user()->role == 'superadmin'){
            return $next($request);
        } elseif (auth()->check() && $request->user()->role == 'sarpras'){
            return redirect()->guest('/sarpras/index');
        } elseif (auth()->check() && $request->user()->role == 'tu'){
            return redirect()->guest('/tu/index');
        } else {
            return redirect()->guest('/admin/index');
        }
    }
}
