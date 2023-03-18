<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Speciality;
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
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        
        return view('home')->with(['specialities'=>Speciality::all()]);
    }
    public function clientIndex()
    {
        $appointments = Appointment::where('user_id',auth()->user()->id)->where('date_time','>=',now())->orderby('date_time')->get();
        $specialities = Speciality::all();
        return view('home',compact('appointments','specialities'));
    }
}
