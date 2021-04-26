<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class SessionController extends Controller
{

    /**
     * Get session information
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function get(Request $request)
    {
        // Default response
        $response = array(
            'session_expired' => false,
            'session_required' => true,
            'session_lifetime' => env('SESSION_LIFETIME') ?? 120,
        );

        // Routes to ignore
        $ignore_routes = array(
            'login',
            'logout',
            'password.confirm',
            'password.request',
            'password.reset',
        );

        // Requested route
        $route = app('router')->getRoutes()->match(app('request')->create($request->server('HTTP_REFERER')))->getName();

        if (in_array($route, $ignore_routes )) {
            $response['session_required'] = false;
            return json_encode($response);
        }

        if (empty(auth()->user())) {
            $response['session_expired'] = true;
            return json_encode($response);
        }

        return json_encode($response);
    }
}
