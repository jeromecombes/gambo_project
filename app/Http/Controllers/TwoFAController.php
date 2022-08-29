<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Models\UserAgent;
use App\Models\UserCode;

class TwoFAController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        return view('auth/2fa');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function store(Request $request)
    {
        $request->validate([
            'code'=>'required',
        ]);

        $find = UserCode::where('user_id', auth()->user()->id)
                        ->where('code', $request->code)
                        ->where('updated_at', '>=', now()->subMinutes(20))
                        ->first();

        if (!empty($find)) {
            Session::put('2FAVerified', true);

            UserAgent::UpdateOrCreate([
                'user_id' => auth()->user()->id,
                'ip' => $request->ip(),
                'agent' => $_SERVER['HTTP_USER_AGENT'],
	    ],
	    ['updated_at' => now()]
	    );

            return redirect()->route('home');
        }

        return back()->with('error', 'You entered wrong code.');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function resend()
    {
        auth()->user()->generateCode();
        $partialEmail = auth()->user()->partialEmail;
        return back()->with('success', "We sent your code to your email address ($partialEmail).");
    }
}
