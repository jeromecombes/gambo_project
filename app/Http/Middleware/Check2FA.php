<?php

namespace App\Http\Middleware;

use App\Models\UserAgent;
use Auth;
use Closure;
use Illuminate\Http\Request;
use Session;

class Check2FA
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if ($this->need2fa($request)) {
            auth()->user()->generateCode();
            return redirect()->route('2fa.index');
        }

        Session::put('2FAVerified', true);

        return $next($request);
    }

    private function need2fa(Request $request)
    {
        if (Session::has('2FAVerified')) {
            return false;
        }

        $userAgent = UserAgent::where([
            'user_id' => auth()->user()->id,
            'ip' => $request->ip(),
            'agent' => $_SERVER['HTTP_USER_AGENT'],
        ])
        ->where('updated_at', '>', now()->subDays(90))
        ->first();

        if (empty($userAgent)) {
            return true;
        }

        return false;
    }
}
