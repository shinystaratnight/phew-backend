<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;

class UserMiddleware
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
        if (!User::where('type', 'client')->find(auth('api')->id()))
            return response()->json(['status' => 'false', 'message' => trans('app.messages.client_not_found'), 'data' => null], 404);
        $client = User::where('type', 'client')->find(auth('api')->id());
        if ($client->is_active == false)
            return response()->json(['status' => 'false', 'message' => trans('app.messages.deactivated_account'), 'data' => null], 403);
        if ($client->is_banned == true)
            return response()->json(['status' => 'false', 'message' => trans('app.messages.banned_account'), 'data' => null], 401);
        return $next($request);
    }
}
