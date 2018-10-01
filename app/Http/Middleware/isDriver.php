<?php

namespace App\Http\Middleware;

use Closure;

class isDriver
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
        if (auth()->user()->driver !== 1) {
            return redirect('/')->with('warning', 'Nie masz dostępu do tej strony.');
        }
        return $next($request);
    }
}
