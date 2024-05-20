<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\City;
use App\Models\Motif;
use App\Models\Parametre;
use App\Models\Speciality;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AppointmentController extends Controller
{
    public function index(){
        $appointments = Appointment::where('doctor_id', Auth::id())
                      ->whereNotIn('status', ['completed', 'cancelled'])->get();
        return view('doctor.appointment.index',compact('appointments'));
    }
    public function historique(){

        $appointments = Appointment::where('doctor_id', Auth::id())
            ->whereIn('status', ['completed', 'cancelled'])->get();
        return view('doctor.appointment.historique', compact('appointments'));
    }

    public function modify($appointmentId)
    {
        // $matchedSpecialties = [];
        $parametres = Parametre::where('doctor_id',Auth::user()->id)->first();
        $serializedSpecialities = $parametres->speciality_id;
        $selectedSpecialities = unserialize($serializedSpecialities);
        $serializedmotifs = $parametres->motifs_id;
        $selectedmotifs = unserialize($serializedmotifs);

        // dd($selectedSpecialities);
        $specialities = Speciality::whereIn('id',$selectedSpecialities)->get();
        $motifs = Motif::whereIn('id', $selectedmotifs)->get();
        // dd($specialities);
        $appointmentget = Appointment::with("motif:id,nom_motif")->find($appointmentId);
        $patient = User::with('city:id,nom_city')->findOrFail($appointmentget->patient_id);
        // $reason = Motif::findOrFail($appointmentget->motif_is)->;
        return response()->json([$appointmentget,$specialities,$motifs,$patient]);
    }
    public function update(Request $request){


        $appointment_get = Appointment::findOrFail($request->id_appointment);
        $appointment_get->medical_information = $request->medical_information ?? $appointment_get->medical_information;
        $appointment_get->motif_id = $request->reason_consult ?? $appointment_get->motif_id;
        $appointment_get->type_appointment = $request->type;
        $appointment_get->controle = $request->controle;
        $appointment_get->status = $request->status ?? $appointment_get->status ;
        $appointment_get->save();

        return redirect()->route('appointment.index')->with('success','the appointment has been updated successfully');
    }

    public function delete($id){
        $appointment_get = Appointment::findOrFail($id);
        $appointment_get->delete();

        return redirect()->route('appointment.index')->with('success', 'the appointment has been cancelled successfully');

    }
}
