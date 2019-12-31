<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class AcceptDebugUserId
{
    public function handle(Request $request, Closure $next)
    {
        if (App::isLocal() && config('app.debug') && $request->hasHeader('X-Debug-User-Id') && ($user = User::find($request->header('X-Debug-User-Id')))) {
            Auth::login($user);
        }
        return $next($request);
    }
}
