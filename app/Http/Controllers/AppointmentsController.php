<?php

namespace App\Http\Controllers;

use App\Filters\Appointment\AppointmentIndexFilter;
use App\Models\Appointment;
use App\Models\Speciality;
use Illuminate\Http\Request;

class AppointmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $appointments = Appointment::filter(new AppointmentIndexFilter(request()))->where('date_time','>=',now())->orderby('date_time')->get();
        $specialities = Speciality::all();
        return view('admin.appointments',compact('appointments','specialities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $d = $request->input('day');
        $h = $request->input('hour');
        $m = $request->input('minute');
        $str = $d.' '.$h.':'.$m.':00';
        
        // Also I can use create() function
        $appointment = new Appointment();
        $appointment->speciality_id = $request->speciality;
        $appointment->user_id = auth()->user()->id;
        $appointment->date_time = $str;
        $appointment->save();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $appointment = Appointment::findOrFail($id);
        // dd(date("Y-m-d", strtotime($appointment->date_time)),date("i", strtotime($appointment->date_time)));
        $appointments = Appointment::where('user_id',auth()->user()->id)->where('date_time','>=',now())->orderby('date_time')->get();
        $specialities = Speciality::all();
        return view('edit',compact('appointments','appointment','specialities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $appointment = Appointment::find($id);
        $d = $request->input('day');
        $h = $request->input('hour');
        $m = $request->input('minute');
        $date = $d.' '.$h.':'.$m.':00';
        $appointment->update([
            'speciality_id'=>$request->speciality,
            'date_time'=>$date,
        ]);

        return redirect()->route('home.client');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $appointment = Appointment::find($id);
        $appointment->delete();
        
        return redirect()->route('home.client');
    }
}
