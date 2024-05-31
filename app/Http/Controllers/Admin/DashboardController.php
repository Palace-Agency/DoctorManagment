<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller{
    public function index(){
        $now = Carbon::now();
        // $patient = User::role('patient')->whereMonth('created_at', $now->month)->get();
        // $doctors = User::role('doctor')->whereMonth('created_at', $now->month)->get();

        // $appointmentsInMonth = Appointment::whereMonth('appontment_date', $now->month)
        //                             ->get()->count();

        // Retrieve appointments for the current month and year
        // $janv = Appointment::whereMonth('appointments.appontment_date', '=', 1)->where('status', '=', 'completed')->count();
        // $fevr = Appointment::whereMonth('appointments.appontment_date', '=', 2)->where('status', '=', 'completed')->count();
        // $mars = Appointment::whereMonth('appointments.appontment_date', '=', 3)->where('status', '=', 'completed')->count();
        // $april = Appointment::whereMonth('appointments.appontment_date', '=', 4)->where('status', '=', 'completed')->count();
        // $mai = Appointment::whereMonth('appointments.appontment_date', '=', 5)->where('status', '=', 'completed')->count();
        // $juin = Appointment::whereMonth('appointments.appontment_date', '=', 6)->where('status', '=', 'completed')->count();
        // $juillet = Appointment::whereMonth('appointments.appontment_date', '=', 7)->where('status', '=', 'completed')->count();
        // $aout = Appointment::whereMonth('appointments.appontment_date', '=', 8)->where('status', '=', 'completed')->count();
        // $septembre = Appointment::whereMonth('appointments.appontment_date', '=', 9)->where('status', '=', 'completed')->count();
        // $octobre = Appointment::whereMonth('appointments.appontment_date', '=', 10)->where('status', '=', 'completed')->count();
        // $novembre = Appointment::whereMonth('appointments.appontment_date', '=', 11)->where('status', '=', 'completed')->count();
        // $decembre = Appointment::whereMonth('appointments.appontment_date', '=', 12)->where('status', '=', 'completed')->count();

        // $janviercancelled = Appointment::whereMonth('appointments.appontment_date', '=', 1)->where('status', '=', 'cancelled')->count();
        // $fevriercancelled = Appointment::whereMonth('appointments.appontment_date', '=', 2)->where('status', '=', 'cancelled')->count();
        // $marscancelled = Appointment::whereMonth('appointments.appontment_date', '=', 3)->where('status', '=', 'cancelled')->count();
        // $aprilcancelled = Appointment::whereMonth('appointments.appontment_date', '=', 4)->where('status', '=', 'cancelled')->count();
        // $maicancelled = Appointment::whereMonth('appointments.appontment_date', '=', 5)->where('status', '=', 'cancelled')->count();
        // $juincancelled = Appointment::whereMonth('appointments.appontment_date', '=', 6)->where('status', '=', 'cancelled')->count();
        // $juilletcancelled = Appointment::whereMonth('appointments.appontment_date', '=', 7)->where('status', '=', 'cancelled')->count();
        // $aoutcancelled = Appointment::whereMonth('appointments.appontment_date', '=', 8)->where('status', '=', 'cancelled')->count();
        // $septembrecancelled = Appointment::whereMonth('appointments.appontment_date', '=', 9)->where('status', '=', 'cancelled')->count();
        // $octobrecancelled = Appointment::whereMonth('appointments.appontment_date', '=', 10)->where('status', '=', 'cancelled')->count();
        // $novembrecancelled = Appointment::whereMonth('appointments.appontment_date', '=', 11)->where('status', '=', 'cancelled')->count();
        // $decembrecancelled = Appointment::whereMonth('appointments.appontment_date', '=', 12)->where('status', '=', 'cancelled')->count();

        $jn = User::role('doctor')->whereMonth('users.created_at', '=', 1)->count();
        $feb = User::role('doctor')->whereMonth('users.created_at', '=', 2)->count();
        $mar = User::role('doctor')->whereMonth('users.created_at', '=', 3)->count();
        $apr = User::role('doctor')->whereMonth('users.created_at', '=', 4)->count();
        $may = User::role('doctor')->whereMonth('users.created_at', '=', 5)->count();
        $jun = User::role('doctor')->whereMonth('users.created_at', '=', 6)->count();
        $jul = User::role('doctor')->whereMonth('users.created_at', '=', 7)->count();
        $aug = User::role('doctor')->whereMonth('users.created_at', '=', 8)->count();
        $sep = User::role('doctor')->whereMonth('users.created_at', '=', 9)->count();
        $oct = User::role('doctor')->whereMonth('users.created_at', '=', 10)->count();
        $nov = User::role('doctor')->whereMonth('users.created_at', '=', 11)->count();
        $dec = User::role('doctor')->whereMonth('users.created_at', '=', 12)->count();

        $jn1 = User::role('patient')->whereMonth('users.created_at', '=', 1)->count();
        $feb2 = User::role('patient')->whereMonth('users.created_at', '=', 2)->count();
        $mar3 = User::role('patient')->whereMonth('users.created_at', '=', 3)->count();
        $apr4 = User::role('patient')->whereMonth('users.created_at', '=', 4)->count();
        $may5 = User::role('patient')->whereMonth('users.created_at', '=', 5)->count();
        $jun6 = User::role('patient')->whereMonth('users.created_at', '=', 6)->count();
        $jul7 = User::role('patient')->whereMonth('users.created_at', '=', 7)->count();
        $aug8 = User::role('patient')->whereMonth('users.created_at', '=', 8)->count();
        $sep9 = User::role('patient')->whereMonth('users.created_at', '=', 9)->count();
        $oct10 = User::role('patient')->whereMonth('users.created_at', '=', 10)->count();
        $nov11 = User::role('patient')->whereMonth('users.created_at', '=', 11)->count();
        $dec12 = User::role('patient')->whereMonth('users.created_at', '=', 12)->count();
        $doctorcount = [$jn, $feb, $mar, $apr, $may, $jun, $jul, $aug, $sep, $oct, $nov, $dec];
        $patientcount = [$jn1, $feb2, $mar3, $apr4, $may5, $jun6, $jul7, $aug8, $sep9, $oct10, $nov11, $dec12];

        // $chartcompleted = [$janv, $fevr, $mars, $april, $mai, $juin, $juillet, $aout, $septembre, $octobre, $novembre, $decembre];
        // $chartcancelled = [
        //     $janviercancelled, $fevriercancelled, $marscancelled, $aprilcancelled, $maicancelled, $juincancelled, $juilletcancelled, $aoutcancelled,
        //     $septembrecancelled,
        //     $octobrecancelled,
        //     $novembrecancelled,
        //     $decembrecancelled
        // ];


        return view('admin.dashboard',compact('now', 'patientcount', 'doctorcount'));
    }


    // public function fetchTotalAppointmentByRangeDate(Request $request){
    //     $current = Carbon::now();
    //     $months = $request->input('month');
    //     $appointmentCount = 0;

    //     if (is_array($months) && count($months) == 1) {
    //         // Only one month is selected
    //         $selectedMonth = $months[0]['value'];
    //         $appointmentCount = Appointment::whereMonth('appontment_date', $selectedMonth)->count();
    //         $patients = User::role('patient')->whereMonth('created_at', $selectedMonth)->count();
    //         $doctors = User::role('doctor')->whereMonth('created_at', $selectedMonth)->count();
    //     } else if (is_array($months) && count($months) > 1) {
    //         // More than one month is selected, use whereIn to match exactly the selected months
    //         $monthValues = array_column($months, 'value');
    //         $patients = User::role('patient')->whereIn(DB::raw('MONTH(created_at)'), $monthValues)->count();
    //         $doctors = User::role('doctor')->whereIn(DB::raw('MONTH(created_at)'), $monthValues)->count();
    //         $appointmentCount = Appointment::whereIn(DB::raw('MONTH(appontment_date)'), $monthValues)->count();
    //     } else {
    //         // No months selected, use the current month
    //         $patients = User::role('patient')->whereMonth('created_at', $current->month)->count();
    //         $doctors = User::role('doctor')->whereMonth('created_at', $current->month)->count();

    //         $appointmentCount = Appointment::whereMonth('appontment_date', $current->month)->count();
    //     }

    //     return response()->json([$appointmentCount,$patients,$doctors]);
    // }


    public function fetchTotalAppointmentByRangeDate(Request $request)
    {
        // dd($request);
        $appointmentCount = 0;

        $dateInput = $request->month;

        if (strpos($dateInput, ' to ') !== false) {
            // Date range provided
            $date = explode(' to ', $dateInput);

            $startDate = Carbon::createFromFormat('Y-m-d', trim($date[0]));
            $endDate = Carbon::createFromFormat('Y-m-d', trim($date[1]));


            if ($startDate->greaterThanOrEqualTo($endDate)) {
                // Debugging output
                return response()->json(['error' => 'Start date cannot be greater than or equal to end date'], 400);
            }

            $appointmentCount = Appointment::whereBetween('appontment_date', [$startDate, $endDate])->count();
            $patients = User::role('patient')->whereBetween('created_at', [$startDate, $endDate])->count();
            $doctors = User::role('doctor')->whereBetween('created_at', [$startDate, $endDate])->count();

        } else {

            $singleDate = Carbon::createFromFormat('Y-m-d', trim($dateInput));
            $month = $singleDate->format('F'); // Full month name
            $appointmentCount = Appointment::where('appontment_date', $singleDate)->count();
            $patients = User::role('patient')->whereDate('created_at', $singleDate)->count();
            $doctors = User::role('doctor')->whereDate('created_at', $singleDate)->count();

        }

        return response()->json([$appointmentCount, $patients, $doctors]);
    }
}
