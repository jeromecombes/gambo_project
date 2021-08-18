<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin')->except(['account', 'password']);
        $this->middleware('role:9|10|11|12')->only('index');
        $this->middleware('role:10|11|12')->only(['edit', 'update']);
    }

    /**
     * Show My Account form
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function account(Request $request)
    {
        // View
        return view('user.account');
    }

    /**
     * Delete an user
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        User::find($request->id)->delete();

        return redirect()->route('users.index')->with('success', 'The user has been deleted');
    }

    /**
     * Show an user form
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $user = User::firstOrNew(['id' => $request->id]);

        $password_attributes = ['onkeyup' => 'password_ctrl(this);', 'onblur' => 'password_ctrl(this);', 'required'];

        if ($request->id) {
            $password_attributes['disabled'] = 'disabled';
        }

        $accesses = array(
            [1, 'Voir les infos générales'],
            [2, 'Voir les Housings'],
            [3, 'Voir les documents'],
            [4, 'Ajouter des étudiants'],
            [5, 'Supprimer les étudiants'],
            [6, 'Modifier les infos générales'],
            [7, 'Modifier les Housings'],
            [8, 'Modifier les documents'],
            [9, 'Voir les utilisateurs'],
            [10, 'Modifier les utilisateurs'],
            [11, 'Ajouter des utilisateurs'],
            [12, 'Supprimer les utilisateurs'],
            [13, 'Modifier les formulaires'],
            [22, 'Voir qui a rempli les évaluations'],
            [15, 'Voir les évaluations'],
            [23, 'Voir les cours'],
            [16, 'Modifier les cours'],
            [17, 'Voir Univ. Reg.'],
            [18, 'Voir et modifier les Notes FR'],
            [20, 'Voir les Notes FR et US'],
            [19, 'Voir et modifier les Notes US'],
            [21, 'Bloc-notes des cours'],
            [24, 'Modifier les dates (1ère page)'],
        );

        // View
        return view('user.edit', compact('user', 'accesses', 'password_attributes'));
    }

    /**
     * Show the user's list
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::where('admin', 1)->get();

        // View
        return view('user.index', compact('users'));
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

        $user->password = Hash::make($password);
        $user->save();

        return redirect()->route('account.index')->with('success', 'Password changed !');
    }

    /**
     * Update an user
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request)
    {
        $access = $request->access;
        if (in_array(15, $access)
            and in_array(22, $access)) {
            $key = array_search(22, $access) + 1;
            array_splice($access, $key, 1);
        }

        $user = User::findOrNew($request->id);
        $user->lastname = $request->lastname;
        $user->firstname = $request->firstname;
        $user->email = $request->email;
        $user->university = $request->university;
        $user->language = $request->language;
        $user->alerts = $request->alerts;
        $user->access = $access;
        $user->admin = 1;
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        $message = $request->id ? "The user has been changed !" : "New user successfully added !";

        return redirect()->route('users.index')->with('success', $message);
    }

}
