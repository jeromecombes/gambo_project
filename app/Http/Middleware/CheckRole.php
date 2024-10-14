<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
//         if (! $request->user()->hasRole($role)) {
//             // Redirect...
//         }

        $user = $request->user();

        // Don't check for students
        if (!$user->admin) {
            return $next($request);
        }

        $roles = explode('|', $role);
        $redirect = true;

        foreach ($roles as $role) {
            if (in_array($role, $user->access)) {
                $redirect = false;
                break;
            }
        }

        if ($redirect) {
            return redirect()->route('project.index')->with('warning', 'Access denied');
        }

        return $next($request);
    }

}
