<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
class setLocale
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
        $lang = 'ar';
        if($request->header('lang')){
            $lang = $request->header('lang');
        }elseif($request->header('Accept-Language')){
            $lang = $request->header('Accept-Language');
        }
        app()->setLocale($lang);
        Carbon::setLocale(app()->getLocale());
        return $next($request);
    }
}
