<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Expense;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardDocController extends Controller
{
    public function index(){
        $now = Carbon::now();
        $today = Carbon::today()->toDateString();

        $totalapp = Appointment::with('patient')->where('doctor_id',Auth::id())->whereMonth('appointments.appontment_date', $now->month)->get()->count();
        $appointments = Appointment::with('patient')->where('doctor_id',Auth::id())->where('appontment_date', $today)
        ->orderBy('start_at')
        ->get();
        $employees = User::role('employee')->where('doctor_id',Auth::id())->get();
        $patients = User::role('patient')->where('doctor_id', Auth::id())->get();
        $expenses = Expense::where('doctor_id',Auth::id())->whereYear('created_at', $now->year)->where('status','paid')->sum('amount');

        $appointmentcount = Appointment::where('doctor_id',Auth::id())->whereMonth('appointments.appontment_date', '=', $now->month)->where('status', '=', 'completed')->count();

        $jn = User::role('patient')->where('doctor_id',Auth::id())->whereMonth('users.created_at', '=', 1)->count();
        $feb = User::role('patient')->where('doctor_id',Auth::id())->whereMonth('users.created_at', '=', 2)->count();
        $mar = User::role('patient')->where('doctor_id',Auth::id())->whereMonth('users.created_at', '=', 3)->count();
        $apr = User::role('patient')->where('doctor_id',Auth::id())->whereMonth('users.created_at', '=', 4)->count();
        $may = User::role('patient')->where('doctor_id',Auth::id())->whereMonth('users.created_at', '=', 5)->count();
        $jun = User::role('patient')->where('doctor_id',Auth::id())->whereMonth('users.created_at', '=', 6)->count();
        $jul = User::role('patient')->where('doctor_id',Auth::id())->whereMonth('users.created_at', '=', 7)->count();
        $aug = User::role('patient')->where('doctor_id',Auth::id())->whereMonth('users.created_at', '=', 8)->count();
        $sep = User::role('patient')->where('doctor_id',Auth::id())->whereMonth('users.created_at', '=', 9)->count();
        $oct = User::role('patient')->where('doctor_id',Auth::id())->whereMonth('users.created_at', '=', 10)->count();
        $nov = User::role('patient')->where('doctor_id',Auth::id())->whereMonth('users.created_at', '=', 11)->count();
        $dec = User::role('patient')->where('doctor_id',Auth::id())->whereMonth('users.created_at', '=', 12)->count();

        $janv = Appointment::where('doctor_id',Auth::id())->whereMonth('appointments.appontment_date', '=', 1)->where('status', '=', 'completed')->count();
        $fevr = Appointment::where('doctor_id',Auth::id())->whereMonth('appointments.appontment_date', '=', 2)->where('status', '=', 'completed')->count();
        $mars = Appointment::where('doctor_id',Auth::id())->whereMonth('appointments.appontment_date', '=', 3)->where('status', '=', 'completed')->count();
        $april = Appointment::where('doctor_id',Auth::id())->whereMonth('appointments.appontment_date', '=', 4)->where('status', '=', 'completed')->count();
        $mai = Appointment::where('doctor_id',Auth::id())->whereMonth('appointments.appontment_date', '=', 5)->where('status', '=', 'completed')->count();
        $juin = Appointment::where('doctor_id',Auth::id())->whereMonth('appointments.appontment_date', '=', 6)->where('status', '=', 'completed')->count();
        $juillet = Appointment::where('doctor_id',Auth::id())->whereMonth('appointments.appontment_date', '=', 7)->where('status', '=', 'completed')->count();
        $aout = Appointment::where('doctor_id',Auth::id())->whereMonth('appointments.appontment_date', '=', 8)->where('status', '=', 'completed')->count();
        $septembre = Appointment::where('doctor_id',Auth::id())->whereMonth('appointments.appontment_date', '=', 9)->where('status', '=', 'completed')->count();
        $octobre = Appointment::where('doctor_id',Auth::id())->whereMonth('appointments.appontment_date', '=', 10)->where('status', '=', 'completed')->count();
        $novembre = Appointment::where('doctor_id',Auth::id())->whereMonth('appointments.appontment_date', '=', 11)->where('status', '=', 'completed')->count();
        $decembre = Appointment::where('doctor_id',Auth::id())->whereMonth('appointments.appontment_date', '=', 12)->where('status', '=', 'completed')->count();

        $janviercancelled = Appointment::where('doctor_id',Auth::id())->whereMonth('appointments.appontment_date', '=', 1)->where('status', '=', 'cancelled')->count();
        $fevriercancelled = Appointment::where('doctor_id',Auth::id())->whereMonth('appointments.appontment_date', '=', 2)->where('status', '=', 'cancelled')->count();
        $marscancelled = Appointment::where('doctor_id',Auth::id())->whereMonth('appointments.appontment_date', '=', 3)->where('status', '=', 'cancelled')->count();
        $aprilcancelled = Appointment::where('doctor_id',Auth::id())->whereMonth('appointments.appontment_date', '=', 4)->where('status', '=', 'cancelled')->count();
        $maicancelled = Appointment::where('doctor_id',Auth::id())->whereMonth('appointments.appontment_date', '=', 5)->where('status', '=', 'cancelled')->count();
        $juincancelled = Appointment::where('doctor_id',Auth::id())->whereMonth('appointments.appontment_date', '=', 6)->where('status', '=', 'cancelled')->count();
        $juilletcancelled = Appointment::where('doctor_id',Auth::id())->whereMonth('appointments.appontment_date', '=', 7)->where('status', '=', 'cancelled')->count();
        $aoutcancelled = Appointment::where('doctor_id',Auth::id())->whereMonth('appointments.appontment_date', '=', 8)->where('status', '=', 'cancelled')->count();
        $septembrecancelled = Appointment::where('doctor_id',Auth::id())->whereMonth('appointments.appontment_date', '=', 9)->where('status', '=', 'cancelled')->count();
        $octobrecancelled = Appointment::where('doctor_id',Auth::id())->whereMonth('appointments.appontment_date', '=', 10)->where('status', '=', 'cancelled')->count();
        $novembrecancelled = Appointment::where('doctor_id',Auth::id())->whereMonth('appointments.appontment_date', '=', 11)->where('status', '=', 'cancelled')->count();
        $decembrecancelled = Appointment::where('doctor_id',Auth::id())->whereMonth('appointments.appontment_date', '=', 12)->where('status', '=', 'cancelled')->count();
        $appointmentcompleted = [$janv, $fevr, $mars, $april, $mai, $juin, $juillet, $aout, $septembre, $octobre, $novembre, $decembre];
        $appointmentcancelled = [
            $janviercancelled, $fevriercancelled, $marscancelled, $aprilcancelled, $maicancelled, $juincancelled, $juilletcancelled, $aoutcancelled,
            $septembrecancelled,
            $octobrecancelled,
            $novembrecancelled,
            $decembrecancelled
        ];
        $patientcount = [$jn, $feb, $mar, $apr, $may, $jun, $jul, $aug, $sep, $oct, $nov, $dec];


        return view('doctor.dashboard',compact('now','appointments','employees','patients','expenses',
            'appointmentcompleted',
            'appointmentcancelled',
            'patientcount',
            'totalapp',
            'appointmentcount'
        ));
    }

    public function fetchTotalAppointmentsandpaid(Request $request){
        

        $appointmentcount = Appointment::where('doctor_id', Auth::id())->whereMonth('appointments.appontment_date', '=', $request->month)->where('status', '=', 'completed')->count();
        $totalapp = Appointment::with('patient')->where('doctor_id', Auth::id())->whereMonth('appointments.appontment_date', $request->month)->get()->count();

        return response()->json([$appointmentcount, $totalapp]);

    }
}
