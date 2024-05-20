<?php

namespace App\Http\Controllers\Doctor;

use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Medicament;
use App\Models\Motif;
use App\Models\Observation;
use App\Models\Parametre;
use App\Models\Speciality;
use App\Models\User;
use App\Models\Vacation;
use App\Models\WorkingHour;
use Carbon\Carbon;
use App\Mail\AccountPatientMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class MyPatientController extends Controller
{
    public function index(){

            $patients = User::role('patient')->where('doctor_id', Auth::id())->get();
            return view('doctor.mypatient.index', compact('patients'));

    }

    public function create(){

        return view('doctor.mypatient.create');
    }
    public function store(Request $request){
        // dd($request);

        $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            'city_id' => 'required',
            'phone' => 'required',
            'adresse' => 'required|min:5|max:40',
            'gender' => 'required',
            'zip_code' => 'required',
            "email" => 'required|unique:users,email'
        ]);
        $file_name = 'default.png';

        $user = User::create([
            'fname' => $request->fname,
            'doctor_id' => Auth::id(),
            'lname' => $request->lname,
            'gender' => $request->gender,
            'city_id' => $request->city_id,
            'adresse' => $request->adress,
            'zip_code' => $request->zip_code,
            'phone_number' => $request->phone,
            'image' => $file_name,
            'date_naissance' => $request->datenaiss,
            'email' => $request->email,
            'password' => Hash::make('password') ,
        ]);
        $user->assignRole('patient');
        Mail::to($user->email)->send(new AccountPatientMail($user));
        return redirect()->route('mypatient.index')->with("success", "the account is created successfully");

    }
    public function update(Request $request, $idmypatient)
    {

        $validator = Validator::make($request->all(), [
            'fname' => 'required',
            'lname' => 'required',
            'gender' => 'required',
            'city_id' => 'required',
            'zip_code' => 'required',
            'datenaiss' => 'required',
            'phone' => 'required',
            'adresse' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['danger' => $validator->errors()]);
        }
        $patient = User::findOrFail($idmypatient);

        $patient->fname = $request->fname;
        $patient->doctor_id = Auth::id();
        $patient->lname = $request->lname;
        $patient->gender = $request->gender;
        $patient->city_id = $request->city_id;
        $patient->address = $request->adresse;
        $patient->zip_code = $request->zip_code;
        $patient->phone_number = $request->phone;
        $patient->date_naissance = $request->datenaiss;
        $patient->email = $request->email;
        $patient->save();
        return response()->json(['success' => 'the information saved successfully']);
    }

    // Import Response class
    public function getObservationId($observationId){

        $observationGet = Observation::findOrFail($observationId);

        return response()->json([$observationGet]);
    }

    public function observationUpdate(Request $request, $idobservation)
    {
        $observationGet = Observation::findOrFail($idobservation);
        // dd($request);
        $observationGet->observation_desc = $request->observation;
        $observationGet->save();
        return response()->json(['success' => 'the observation has been Updated successfully']);
    }
    public function observation(Request $request, $idmypatient)
    {
        Observation::create([
            'doctor_id' => Auth::id(),
            'patient_id' => $idmypatient,
            'observation_desc' => $request->observation
        ]);
        return response()->json(['success' => 'the observation has been created successfully']);
    }

    public function deleteobservation($idobservation)
    {
        $observationGet = Observation::findOrFail($idobservation);
        $observationGet->delete();
        return back()->with('success', 'the observation has been deleted successfully');
    }

    public function getObservation($idpatient)
    {
        $observations = Observation::where('doctor_id', Auth::id())->where('patient_id', $idpatient)->get();
        return response()->json($observations);
    }


    public function details($idmypatient){
        $patient = User::findOrFail($idmypatient);
        // dd($patient);
        $now = Carbon::now();
        $holidays = Vacation::where('doctor_id', Auth::user()->id)->get();
        $workhours = WorkingHour::where('doctor_id', Auth::user()->id)->get();

        $difftime = Parametre::where('doctor_id', Auth::user()->id)->first();
        $parametres = Parametre::where('doctor_id', Auth::user()->id,)->first();
        $serializedSpecialities = $parametres->speciality_id;
        $selectedSpecialities = unserialize($serializedSpecialities);
        $serializedmotifs = $parametres->motifs_id;
        $selectedmotifs = unserialize($serializedmotifs);
        $selectedSpecialities = is_array($selectedSpecialities) ? $selectedSpecialities : [];
        $selectedmotifs = is_array($selectedmotifs) ? $selectedmotifs : [];
        $specialities = Speciality::whereIn('id', $selectedSpecialities)->get();
        $motifs = Motif::whereIn('id', $selectedmotifs)->get();
        $appointments = Appointment::where('doctor_id', Auth::id())->where('patient_id', $idmypatient)->get();
        $medicaments = Medicament::all();
        return view('doctor.mypatient.details', compact('appointments', 'patient', 'now', 'workhours', 'difftime', 'holidays', 'specialities', 'motifs', 'medicaments'));
    }


    public function getAppointment($idpatient)
    {
        $appointments = Appointment::with('motif:id,nom_motif')->where('doctor_id', Auth::id())->where('patient_id', $idpatient)->get();
        return response()->json($appointments);
    }

    public function destroyAppointment($idappointment)
    {
        $appointmentdelete = Appointment::findOrFail($idappointment);
        $appointmentdelete->delete();
        return back()->with('success', 'the appointment has been deleted successfully');
    }

    public function updateAppointment(Request $request, $idappointment)
    {
        // dd($request);
        $appointment_get = Appointment::findOrFail($idappointment);
        $appointment_get->medical_information = $request->info ?? $appointment_get->medical_information;
        $appointment_get->motif_id = $request->reason ?? $appointment_get->motif_id;
        $appointment_get->type_appointment = $request->type;
        $appointment_get->controle = $request->controle;
        $appointment_get->status = $request->status ?? $appointment_get->status;
        $appointment_get->save();
        return response()->json(['success' => 'the appointment has been updated successfully']);
    }

    public function makeAppointment(Request $request, $idmypatient)
    {
        $validator = Validator::make($request->all(), [
            'day' => 'required',
            'medical_information' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['danger' => $validator->errors()]);
        }
        $duree = Parametre::where('doctor_id', Auth::user()->id)->first();
        $time = Carbon::createFromFormat('H:i', $request->time);

        $dateAppointment = Carbon::createFromDate($request->year, $request->month, $request->day)->format('Y-m-d');

        Appointment::create([
            'doctor_id' => Auth::id(),
            'patient_id' => $idmypatient,
            'appontment_date' => $dateAppointment,
            'start_at' => $request->time,
            'end_at' => $time->copy()->addMinutes($duree->duree_appointments),
            'medical_information' =>  $request->medical_information,
            'status' => 'pending',
            'motif_id' => $request->reason,
            'type_appointment' => $request->type,
            'controle' => $request->controle,
        ]);

        return response()->json(['success' => 'the appointment has been created successfully']);
    }


    public function getDays(Request $request)
    {
        // dd($request);
        $appointments = Appointment::where('doctor_id', Auth::id())->get();

        $holidays = Vacation::where('doctor_id', Auth::user()->id)->get();
        $now = Carbon::now();
        $difftime = Parametre::where('doctor_id', Auth::user()->id)->first();

        $selectedYear = $request->year;
        $selectedMonth = $request->month;
        $daysInMonth = Carbon::createFromDate($selectedYear, $selectedMonth)->daysInMonth;
        $workhours = WorkingHour::where('doctor_id', Auth::user()->id)->get();
        $html = '';

        for ($now->month == $selectedMonth ? $day = $now->day : $day = 1; $day <= $daysInMonth; $day++) {
            ob_start();
            $currentDate = Carbon::createFromDate($selectedYear, $selectedMonth, $day);

            echo '<div class="item">
                <div class="d-flex justify-content-center bg-primary p-3 rounded-pill">
                    <input type="hidden" class="get-day" name="" value="' . $day . '">'
                . Carbon::createFromDate($selectedYear, $selectedMonth, $day)->format('D. d/m') .
                '</div>
                <div class="vertical-scroll scroll-demo scroll-b-none mt-5">
                    <div class="list-group">';
            $flag = 0;
            foreach ($workhours as $work) {
                $flag == 1 ? '' : $period = [];
                if (strtolower($currentDate->format('l')) === $work->day_of_week) {
                    $startTime = Carbon::parse($work->start_time) ?? null;
                    $endTime = Carbon::parse($work->end_time) ?? null;
                    if ($startTime && $endTime) {
                        $periodStart = $startTime->copy();
                        while ($periodStart->lessThanOrEqualTo($endTime)) {
                            $period[] = $periodStart->copy();
                            $periodStart->addMinutes($difftime->duree_appointments);
                        }
                        if ($currentDate->isToday()) {
                            $isNot = true;
                            foreach ($period as $key => $datetime) {
                                if ($datetime->greaterThan($now)) {
                                    $period = array_slice($period, $key); // Discard past time slots
                                    $isNot = false;
                                    break;
                                }
                            }
                            if ($isNot) {
                                $period = [];
                            }
                        }
                    }

                    $flag = 1;
                    $checkday = $work->day_off === "disable";
                }
            }
            $date = Carbon::createFromFormat('Y-m-d', $selectedYear . '-' . $selectedMonth . '-' . $day);

            foreach ($holidays as $holiday) {
                $holidayStartDate = Carbon::parse($holiday->date_start)->format('Y-m-d');
                $holidayEndDate = Carbon::parse($holiday->date_end)->format('Y-m-d');
                if ($holidayEndDate === $holidayStartDate && $date->format('Y-m-d') === $holidayStartDate) {
                    foreach ($period as $key => $datetime) {
                        if ($datetime->between($holiday->time_start, $holiday->time_end)) {
                            unset($period[$key]);
                        }
                    }
                } else if ($date->between($holidayStartDate, $holidayEndDate)) {
                    if ($date->format('Y-m-d') === $holidayStartDate) {
                        $newPeriod = [];
                        $startTime = Carbon::parse($holiday->time_start);
                        foreach ($period as $datetime) {
                            if ($datetime->lessThan($startTime)) {
                                $newPeriod[] = $datetime->copy();
                            } else {
                                break;
                            }
                        }
                        $period = $newPeriod;
                    } else if ($date->format('Y-m-d') === $holidayEndDate) {
                        $newPeriod = [];
                        $endTime = end($period);
                        $holidayEndTime = Carbon::parse($holiday->time_end);
                        foreach ($period as $datetime) {
                            if ($datetime->greaterThanOrEqualTo($holidayEndTime)) {
                                $newPeriod[] = $datetime->copy();
                            }
                        }
                        $period = $newPeriod;
                    } else {
                        $period = [];
                    }
                }
            }

            foreach ($appointments as $appointment) {
                $date_appointment = Carbon::parse($appointment->appontment_date)->format('Y-m-d');
                $start_at = Carbon::parse($appointment->start_at);
                if ($date->format('Y-m-d') === $date_appointment) {
                    foreach ($period as $key => $datetime) {
                        if ($datetime->eq($start_at)) {
                            // Remove the time slot from $period
                            unset($period[$key]);
                            // Exit the loop for this appointment
                            break;
                        }
                    }
                }
            }

            if (isset($checkday) ?? false) {
                foreach ($period as $datetime) {
                    echo '<a class="list-group-item list-group-item-action time-link list-hover-primary"
                                    href="javascript:void(0)" data-time="' . $datetime->format('G:i') . '">' . $datetime->format('G:i') . '</a>';
                }
            }

            echo '</div>
                </div>
            </div>';

            $html .= ob_get_clean();
        }
        // dd($html );
        // Return the HTML response
        return response()->json(['html' => $html]);
    }
}
