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
        $totalapp = Appointment::with('patient')->where('doctor_id',Auth::id())->get();
        $appointments = Appointment::with('patient')->where('doctor_id',Auth::id())->where('appontment_date', $today)
        ->orderBy('start_at')
        ->get();
        $employees = User::role('employee')->where('doctor_id',Auth::id())->get();
        $patients = User::role('patient')->where('doctor_id', Auth::id())->get();
        $expenses = Expense::where('doctor_id',Auth::id())->whereYear('created_at', $now->year)->where('status','paid')->sum('amount');
        $expensesunpaid = Expense::where('status', '=', 'unpaid')->sum('expenses.amount');
        $expensespaid = Expense::where('status', '=', 'paid')->sum('expenses.amount');

        return view('doctor.dashboard',compact('now','appointments','employees','patients','expenses','expensesunpaid','expensespaid',
        'totalapp'));
    }
}
