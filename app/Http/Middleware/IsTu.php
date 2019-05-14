<?php

namespace App\Http\Middleware;

use Closure;

class IsTu
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
        if (auth()->check() && $request->user()->role == 'tu') {
            return $next($request);
        } elseif (auth()->check() && $request->user()->role == 'sarpras'){
            return redirect()->guest('/sarpras/index');
        } elseif (auth()->check() && $request->user()->role == 'admin'){
            return redirect()->guest('/admin/index');
        } else {
            return redirect()->guest('/superadmin/index');
        }
    }
}
