<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Parametre;
use App\Models\WorkingHour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CalendarController extends Controller
{
    public function index()
    {


        $currentDate = now()->toDateString();
        $appointments = Appointment::with('patient:id,fname,lname')->where('doctor_id',Auth::id())->get();
        $workhours = WorkingHour::where('doctor_id',Auth::id())->get();
        $difftime = Parametre::where('doctor_id', Auth::user()->id)->first();

        return view('doctor.calendar.calendar', compact('currentDate','appointments','workhours','difftime'));
    }


}
