<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class UserController extends Controller
{

    /**
     * Show My Account form
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function account(Request $request)
    {
        $user = auth()->user();

        $notifications = $user->alerts;

        // View
        return view('user.account', compact('notifications'));
    }

    /**
     * Update password
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function password(Request $request)
    {
        $user = auth()->user();

        $current = $request->current;
        $password = $request->password;
        $confirm = $request->confirm;

        if (!password_verify($current, $user->password)) {
            return redirect()->route('account.index')->with('warning', 'The current password is not correct !');
        }

        if ($password != $confirm) {
            return redirect()->route('account.index')->with('warning', "Passwords don't match !");
        }

        if (strlen($password) < 8) {
            return redirect()->route('account.index')->with('warning', "The new password is too short !");
        }

        $crypted_password = password_hash($password, PASSWORD_BCRYPT);

        $user->password = $crypted_password;
        $user->save();

        return redirect()->route('account.index')->with('success', 'Password changed !');
    }

    /**
     * Update notifications preferences
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function notifications(Request $request)
    {
        $user = auth()->user();
        $user->alerts = $request->notifications;
        $user->save();

        return redirect()->route('account.index')->with('success', 'Notifications preferences changed !');
    }

}
