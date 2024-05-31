<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Expense;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardDocController extends Controller
{
    public function index(){
        $now = Carbon::now();
        $today = Carbon::today()->toDateString();

        $totalapp = Appointment::with('patient')->where('doctor_id',Auth::id())->where('appontment_date', $now)->get()->count();
        $appointments = Appointment::with('patient')->where('doctor_id',Auth::id())->where('appontment_date', $today)
        ->orderBy('start_at')
        ->get();
        $employees = User::role('employee')->where('doctor_id',Auth::id())->get();
        $patients = User::role('patient')->where('created_at', $now)->where('doctor_id', Auth::id())->get();
        $expenses = Expense::where('doctor_id',Auth::id())->whereYear('created_at', $now->year)->where('status','paid')->sum('amount');

        $appointmentcount = Appointment::where('doctor_id',Auth::id())->where('appontment_date', '=', $now)->where('status', '=', 'completed')->get()->count();

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

        $janv = Appointment::where('doctor_id',Auth::id())->whereYear('appointments.appontment_date', '=', $now->year)->whereMonth('appointments.appontment_date', '=', 1)->where('status', '=', 'completed')->count();
        $fevr = Appointment::where('doctor_id',Auth::id())->whereYear('appointments.appontment_date', '=', $now->year)->whereMonth('appointments.appontment_date', '=', 2)->where('status', '=', 'completed')->count();
        $mars = Appointment::where('doctor_id',Auth::id())->whereYear('appointments.appontment_date', '=', $now->year)->whereMonth('appointments.appontment_date', '=', 3)->where('status', '=', 'completed')->count();
        $april = Appointment::where('doctor_id',Auth::id())->whereYear('appointments.appontment_date', '=', $now->year)->whereMonth('appointments.appontment_date', '=', 4)->where('status', '=', 'completed')->count();
        $mai = Appointment::where('doctor_id',Auth::id())->whereYear('appointments.appontment_date', '=', $now->year)->whereMonth('appointments.appontment_date', '=', 5)->where('status', '=', 'completed')->count();
        $juin = Appointment::where('doctor_id',Auth::id())->whereYear('appointments.appontment_date', '=', $now->year)->whereMonth('appointments.appontment_date', '=', 6)->where('status', '=', 'completed')->count();
        $juillet = Appointment::where('doctor_id',Auth::id())->whereYear('appointments.appontment_date', '=', $now->year)->whereMonth('appointments.appontment_date', '=', 7)->where('status', '=', 'completed')->count();
        $aout = Appointment::where('doctor_id',Auth::id())->whereYear('appointments.appontment_date', '=', $now->year)->whereMonth('appointments.appontment_date', '=', 8)->where('status', '=', 'completed')->count();
        $septembre = Appointment::where('doctor_id',Auth::id())->whereYear('appointments.appontment_date', '=', $now->year)->whereMonth('appointments.appontment_date', '=', 9)->where('status', '=', 'completed')->count();
        $octobre = Appointment::where('doctor_id',Auth::id())->whereYear('appointments.appontment_date', '=', $now->year)->whereMonth('appointments.appontment_date', '=', 10)->where('status', '=', 'completed')->count();
        $novembre = Appointment::where('doctor_id',Auth::id())->whereYear('appointments.appontment_date', '=', $now->year)->whereMonth('appointments.appontment_date', '=', 11)->where('status', '=', 'completed')->count();
        $decembre = Appointment::where('doctor_id',Auth::id())->whereYear('appointments.appontment_date', '=', $now->year)->whereMonth('appointments.appontment_date', '=', 12)->where('status', '=', 'completed')->count();

        $janviercancelled = Appointment::where('doctor_id',Auth::id())->whereYear('appointments.appontment_date', '=', $now->year)->whereMonth('appointments.appontment_date', '=', 1)->where('status', '=', 'cancelled')->count();
        $fevriercancelled = Appointment::where('doctor_id',Auth::id())->whereYear('appointments.appontment_date', '=', $now->year)->whereMonth('appointments.appontment_date', '=', 2)->where('status', '=', 'cancelled')->count();
        $marscancelled = Appointment::where('doctor_id',Auth::id())->whereYear('appointments.appontment_date', '=', $now->year)->whereMonth('appointments.appontment_date', '=', 3)->where('status', '=', 'cancelled')->count();
        $aprilcancelled = Appointment::where('doctor_id',Auth::id())->whereYear('appointments.appontment_date', '=', $now->year)->whereMonth('appointments.appontment_date', '=', 4)->where('status', '=', 'cancelled')->count();
        $maicancelled = Appointment::where('doctor_id',Auth::id())->whereYear('appointments.appontment_date', '=', $now->year)->whereMonth('appointments.appontment_date', '=', 5)->where('status', '=', 'cancelled')->count();
        $juincancelled = Appointment::where('doctor_id',Auth::id())->whereYear('appointments.appontment_date', '=', $now->year)->whereMonth('appointments.appontment_date', '=', 6)->where('status', '=', 'cancelled')->count();
        $juilletcancelled = Appointment::where('doctor_id',Auth::id())->whereYear('appointments.appontment_date', '=', $now->year)->whereMonth('appointments.appontment_date', '=', 7)->where('status', '=', 'cancelled')->count();
        $aoutcancelled = Appointment::where('doctor_id',Auth::id())->whereYear('appointments.appontment_date', '=', $now->year)->whereMonth('appointments.appontment_date', '=', 8)->where('status', '=', 'cancelled')->count();
        $septembrecancelled = Appointment::where('doctor_id',Auth::id())->whereYear('appointments.appontment_date', '=', $now->year)->whereMonth('appointments.appontment_date', '=', 9)->where('status', '=', 'cancelled')->count();
        $octobrecancelled = Appointment::where('doctor_id',Auth::id())->whereYear('appointments.appontment_date', '=', $now->year)->whereMonth('appointments.appontment_date', '=', 10)->where('status', '=', 'cancelled')->count();
        $novembrecancelled = Appointment::where('doctor_id',Auth::id())->whereYear('appointments.appontment_date', '=', $now->year)->whereMonth('appointments.appontment_date', '=', 11)->where('status', '=', 'cancelled')->count();
        $decembrecancelled = Appointment::where('doctor_id',Auth::id())->whereYear('appointments.appontment_date', '=', $now->year)->whereMonth('appointments.appontment_date', '=', 12)->where('status', '=', 'cancelled')->count();
        $appointmentcompleted = [$janv, $fevr, $mars, $april, $mai, $juin, $juillet, $aout, $septembre, $octobre, $novembre, $decembre];
        $appointmentcancelled = [
            $janviercancelled, $fevriercancelled, $marscancelled, $aprilcancelled, $maicancelled, $juincancelled, $juilletcancelled, $aoutcancelled,
            $septembrecancelled,
            $octobrecancelled,
            $novembrecancelled,
            $decembrecancelled
        ];
        $patientcount = [$jn, $feb, $mar, $apr, $may, $jun, $jul, $aug, $sep, $oct, $nov, $dec];



        $ja = Expense::where('doctor_id', Auth::id())->whereYear('expenses.created_at', '=', $now->year)->whereMonth('expenses.created_at', '=', 1)->where('status', '=', 'paid')->count();
        $fe = Expense::where('doctor_id', Auth::id())->whereYear('expenses.created_at', '=', $now->year)->whereMonth('expenses.created_at', '=', 2)->where('status', '=', 'paid')->count();
        $ma = Expense::where('doctor_id', Auth::id())->whereYear('expenses.created_at', '=', $now->year)->whereMonth('expenses.created_at', '=', 3)->where('status', '=', 'paid')->count();
        $apr = Expense::where('doctor_id', Auth::id())->whereYear('expenses.created_at', '=', $now->year)->whereMonth('expenses.created_at', '=', 4)->where('status', '=', 'paid')->count();
        $m = Expense::where('doctor_id', Auth::id())->whereYear('expenses.created_at', '=', $now->year)->whereMonth('expenses.created_at', '=', 5)->where('status', '=', 'paid')->count();
        $ju = Expense::where('doctor_id', Auth::id())->whereYear('expenses.created_at', '=', $now->year)->whereMonth('expenses.created_at', '=', 6)->where('status', '=', 'paid')->count();
        $juill = Expense::where('doctor_id', Auth::id())->whereYear('expenses.created_at', '=', $now->year)->whereMonth('expenses.created_at', '=', 7)->where('status', '=', 'paid')->count();
        $ao = Expense::where('doctor_id', Auth::id())->whereYear('expenses.created_at', '=', $now->year)->whereMonth('expenses.created_at', '=', 8)->where('status', '=', 'paid')->count();
        $septemb = Expense::where('doctor_id', Auth::id())->whereYear('expenses.created_at', '=', $now->year)->whereMonth('expenses.created_at', '=', 9)->where('status', '=', 'paid')->count();
        $octob = Expense::where('doctor_id', Auth::id())->whereYear('expenses.created_at', '=', $now->year)->whereMonth('expenses.created_at', '=', 10)->where('status', '=', 'paid')->count();
        $novemb = Expense::where('doctor_id', Auth::id())->whereYear('expenses.created_at', '=', $now->year)->whereMonth('expenses.created_at', '=', 11)->where('status', '=', 'paid')->count();
        $decemb = Expense::where('doctor_id', Auth::id())->whereYear('expenses.created_at', '=', $now->year)->whereMonth('expenses.created_at', '=', 12)->where('status', '=', 'paid')->count();


        $ja1 = Expense::where('doctor_id', Auth::id())->whereYear('expenses.created_at', '=', $now->year)->whereMonth('expenses.created_at', '=', 1)->where('status', '=', 'unpaid')->count();
        $fe2 = Expense::where('doctor_id', Auth::id())->whereYear('expenses.created_at', '=', $now->year)->whereMonth('expenses.created_at', '=', 2)->where('status', '=', 'unpaid')->count();
        $ma3 = Expense::where('doctor_id', Auth::id())->whereYear('expenses.created_at', '=', $now->year)->whereMonth('expenses.created_at', '=', 3)->where('status', '=', 'unpaid')->count();
        $apr4 = Expense::where('doctor_id', Auth::id())->whereYear('expenses.created_at', '=', $now->year)->whereMonth('expenses.created_at', '=',4)->where('status', '=', 'unpaid')->count();
        $m5 = Expense::where('doctor_id', Auth::id())->whereYear('expenses.created_at', '=', $now->year)->whereMonth('expenses.created_at', '=', 5)->where('status', '=', 'unpaid')->count();
        $ju6 = Expense::where('doctor_id', Auth::id())->whereYear('expenses.created_at', '=', $now->year)->whereMonth('expenses.created_at', '=', 6)->where('status', '=', 'unpaid')->count();
        $juill7 = Expense::where('doctor_id', Auth::id())->whereYear('expenses.created_at', '=', $now->year)->whereMonth('expenses.created_at', '=', 7)->where('status', '=', 'unpaid')->count();
        $ao8 = Expense::where('doctor_id', Auth::id())->whereYear('expenses.created_at', '=', $now->year)->whereMonth('expenses.created_at', '=', 8)->where('status', '=', 'unpaid')->count();
        $septemb9 = Expense::where('doctor_id', Auth::id())->whereYear('expenses.created_at', '=', $now->year)->whereMonth('expenses.created_at', '=', 9)->where('status', '=', 'unpaid')->count();
        $octob10 = Expense::where('doctor_id', Auth::id())->whereYear('expenses.created_at', '=', $now->year)->whereMonth('expenses.created_at', '=', 10)->where('status', '=', 'unpaid')->count();
        $novemb11 = Expense::where('doctor_id', Auth::id())->whereYear('expenses.created_at', '=', $now->year)->whereMonth('expenses.created_at', '=', 11)->where('status', '=', 'unpaid')->count();
        $decemb12 = Expense::where('doctor_id', Auth::id())->whereYear('expenses.created_at', '=', $now->year)->whereMonth('expenses.created_at', '=', 12)->where('status', '=', 'unpaid')->count();

        $expensespaid = [$ja, $fe, $ma, $apr, $m, $ju, $juill, $ao, $septemb, $octob, $novemb, $decemb];
        $expensesunpaid = [$ja1, $fe2, $ma3, $apr4, $m5, $ju6, $juill7, $ao8, $septemb9, $octob10, $novemb11, $decemb12];


        return view('doctor.dashboard',compact('now','appointments','employees','patients','expenses',
            'appointmentcompleted',
            'appointmentcancelled',
            'patientcount',
            'totalapp',
            'appointmentcount',
            'expensespaid',
            'expensesunpaid',
        ));
    }

    public function fetchTotalAppointmentsandpaid(Request $request){
        $appointmentCount = 0;
        $totalAppointments = 0;
        $patient = 0;
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

            // Fetch appointments count between the dates
            $appointmentCount = Appointment::where('doctor_id', Auth::id())
            ->whereBetween('appontment_date', [$startDate, $endDate])
            ->count();

            $totalAppointments = Appointment::where('doctor_id', Auth::id())
            ->whereBetween('appontment_date', [$startDate, $endDate])
            ->where('status', 'completed')
                ->count();

            $patient = User::role('patient')->where('doctor_id', Auth::id())
                ->whereBetween('created_at', [$startDate, $endDate])

                ->count();
        } else {
            // Single date provided
            $singleDate = Carbon::createFromFormat('Y-m-d', trim($dateInput));
            $month = $singleDate->format('F'); // Full month name

            // Fetch appointments count for the single date's month
            $appointmentCount = Appointment::where('doctor_id', Auth::id())
                ->where('appontment_date', $singleDate)
                ->count();

            $totalAppointments = Appointment::where('doctor_id', Auth::id())
                ->where('appontment_date', $singleDate)
                ->where('status', 'completed')
                ->count();

            $patient = User::role('patient')
                ->where('doctor_id', Auth::id())
                ->whereDate('created_at', $singleDate)
                ->count();
        }

        return response()->json([$appointmentCount, $totalAppointments, $patient]);
    }


}
