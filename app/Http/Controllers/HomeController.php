<?php

namespace App\Http\Controllers;

use App\Models\Dates;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('semester');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dates = Dates::where('semester', session('semester'))->firstOrCreate();

        return view('home', compact('dates'));
    }
}
