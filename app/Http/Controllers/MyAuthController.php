<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MyAuthController extends Controller
{
    /**
     * Logout
     *
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        // Flush Laravel session
        $request->session()->flush();

        // Flush old session
        session_start();
        session_unset();

        return redirect('/');
    }
}
