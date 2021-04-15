<?php

namespace App\Http\Controllers;

use App\Models\Dates;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class DateController extends Controller
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
        $this->middleware('admin');
        $this->middleware('role:24');
    }

    /**
     * Show dates form
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $dates = Dates::where('semester', session('semester'))->first();

        // View
        return view('dates.edit', compact('dates'));
    }

    /**
     * Update dates
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        Dates::updateOrCreate(array('semester' => session('semester')),
            array(
                'date1' => $request->date1,
                'date2' => $request->date2,
                'date3' => $request->date3,
                'date4' => $request->date4,
                'date5' => $request->date5,
                'date6' => $request->date6,
                'date7' => $request->date7,
                'date8' => $request->date8,
            )
        );

        // View
        return redirect()->route('dates.edit')->withSuccess('Dates updated successfull');
    }

}
