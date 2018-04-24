<?php

namespace App\Http\Middleware;

use Closure;

class IsAdmin
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
        if (auth()->user()->admin !== 1) {
            return redirect('/')->with('warning', 'Nie masz dostępu do tej strony.');
        }
        return $next($request);
    }
}
