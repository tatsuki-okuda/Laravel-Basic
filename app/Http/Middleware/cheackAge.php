<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class cheackAge
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // パラメーターの値を抜き題してチェックする。
        if ($request->age <= 20) {
            return redirect('home');
        }

        return $next($request);
    }
}
