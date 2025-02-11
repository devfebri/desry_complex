<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // if (!Auth::check()) {
        //     return redirect('login');
        // }

        // $user = Auth::user();

        // if ($user->role == $roles) {
        //     return $next($request);
        // }
        // return redirect('login')->with('error', "Kamu gak punya akses");


        if (in_array($request->user()->role, $roles)) {
            return $next($request);
        }
        return redirect('/');
    }
}
