<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Speciality;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;

class AppointmentsApiController extends Controller
{
    public function store(Request $request) {
        $request->validate([
            'email' => ['required'],
            'password' => ['required'],
        ]);

        $user = User::where('email' , $request->email)
        ->first();

        if(!$user || !Hash::check($request->password , $user->password)){
            return Response::json([
                'message' => 'Invalid username and password',
            ], 401);
        }

        $token = $user->createToken($request->email);
        $user->save();
        return Response::json([
            'token' => $token->plainTextToken,
            'user' => $user,
        ],200);
    }
    public function getAppointments()
    {
        $user = Auth::guard('sanctum')->user();
        if($user->admin == 0){
            return Response::json([
                'message' => 'Sorry you are not Admin',
            ],401);
        }
        $appointments = Appointment::where('date_time','>=',now())->orderby('date_time')->get();
        
        return Response::json([
            'appointments' => $appointments,
        ],200);
    }

    public function getUserAppointments()
    {
        $user = Auth::guard('sanctum')->user();
        $appointments = Appointment::where('user_id',$user->id)->where('date_time','>=',now())->orderby('date_time')->get();
        
        return Response::json([
            'appointments' => $appointments,
        ],200);
    }

    public function getSpeciality()
    {
        $speciality = Speciality::all();
        
        return Response::json([
            'speciality' => $speciality,
        ],200);
    }

    public function createAppointment(Request $request)
    {
        $user = Auth::guard('sanctum')->user();
        $request->validate([
            'speciality_id' => ['required'],
            'date_time' => ['required'],
        ]);
        $appointment = Appointment::create([
            'speciality_id'=>$request->speciality_id,
            'date_time'=>$request->date_time,
            'user_id'=>$user->id,
        ]);
        
        return Response::json([
            'appointment' => $appointment,
            'message'=>'Appointment Created Successfully'
        ],200);
    }
}
