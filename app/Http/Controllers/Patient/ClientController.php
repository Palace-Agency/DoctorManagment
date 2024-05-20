<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Ordonnance;
use App\Models\Parametre;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{
    public function index(){
        $patient = User::findOrFail(Auth::id());
        return view('patient.index',compact('patient'));
    }

    public function update(Request $request, $idpatient){
        $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            'city_id' => 'required',
            'phone' => 'required',
            'adresse' => 'nullable|min:5|max:40',
            'gender' => 'required',
            'zip_code' => 'nullable|min:5|max:6',
            'password' => 'required|min:8|max:20|confirmed',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4048',
        ]);
        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $file_extention = $file->getClientOriginalExtension();
            $file_name = time() . '.' . $file_extention;
            $path = 'images/employee';
            $file->move($path, $file_name);
        };
        $patient = User::findOrFail($idpatient);
        $patient->fname = $request->fname;
        $patient->lname = $request->lname;
        $patient->gender = $request->gender;
        $patient->address = $request->adresse;
        $patient->city_id = $request->city_id;
        $patient->zip_code = $request->zip_code;
        $patient->image = $file_name ?? $patient->image;
        $patient->phone_number = $request->phone;
        $patient->password = Hash::make($request->password);
        $patient->update();
        return redirect()->route('patient.index')->with("success", "the account has been updated successfully");
    }

    public function appointmentClient(Request $request, $idpatient){
        // Validate the request
        // dd($request);
        $validator = Validator::make($request->all(), [
            'day' => 'required',
            'month' => 'required',
            'year' => 'required',
            'time' => 'required',
            'medical_information' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['danger' => $validator->errors()]);
        }

        try {
            // Get duration from database
            $duree = Parametre::where('doctor_id', $request->idDoctor)->first();
            if (!$duree) {
                return response()->json(['danger' => 'Doctor parameters not found']);
            }

            // Parse the time
            $time = Carbon::createFromFormat('H:i', $request->time);

            // Parse the date
            $dateAppointment = Carbon::createFromDate($request->year, $request->month, $request->day)->format('Y-m-d');

            // Create the appointment
            Appointment::create([
                'doctor_id' => $request->idDoctor,
                'patient_id' => $idpatient,
                'appontment_date' => $dateAppointment,
                'start_at' => $time,
                'end_at' => $time->copy()->addMinutes($duree->duree_appointments),
                'medical_information' => $request->medical_information,
                'status' => 'pending',
                'motif_id' => $request->reason,
                'type_appointment' => $request->type,
                'controle' => $request->controle,
            ]);

            return response()->json(['success' => 'The appointment has been created successfully']);
        } catch (\Exception $e) {
            // Log the error message for debugging
            return response()->json(['danger' => 'An error occurred while creating the appointment']);
        }
    }

    public function showDoctor(){
        $appointments = Appointment::where('patient_id',Auth::id())->get();
        // $doctor = User::where
        return view('patient.patientDoctor',compact('appointments'));
    }

    public function getDoc($idDoctor){
        $doctor = User::with('city')->findOrFail($idDoctor);
        return response()->json([$doctor]);
    }

    public function showOrdonnance(){
        $ordonnances = Ordonnance::where('patient_id',Auth::id())->get();
        return view('patient.ordonnanceDoc',compact('ordonnances'));
    }

}
