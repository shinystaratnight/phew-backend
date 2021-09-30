<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            $user = Auth::guard($guard)->user();
            if ($user->is_active != 1){
                Auth::guard($guard)->logout();
                return view('site.pages.auth.activation',compact('user'))
                    ->withFalse(trans('site.messages.you_not_active'));
            }
            return redirect(RouteServiceProvider::HOME);
        }

        return $next($request);
    }
}
