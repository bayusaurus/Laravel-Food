<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ActiveUser
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
        if (auth()->user()->deactivated_at !== null) {
            $user = auth()->user();
            auth()->logout();
            return redirect()->route('login')
                ->withError('Your account has deactivated at ' . $user->deactivated_at);
        }

        return $next($request);
    }
}
