<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Mail;
use App\Mail\AccountActiveDoctor;

use App\Http\Controllers\Controller;
use App\Models\Motif;
use App\Models\Parametre;
use App\Models\Speciality;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterDoctorController extends Controller
{
    public function index(){
        $specialities = Speciality::all();
        $motifs = Motif::all();
        return view('auth.registerdoctor',compact('specialities', 'motifs'));
    }
    public function store(Request $request){
        $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            'city_id' => 'required',
            'phone' => 'required',
            'specialities' =>'required',
            'gender' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ]);


        // $selectedSpecialities2 = unserialize($serializedSpecialities);

        // dd($selectedSpecialities2);
        $user = User::create([
            'fname' => $request->fname,
            'lname' => $request->lname,
            'gender' => $request->gender,
            'city_id' => $request->city_id,
            'image' => 'default.png',
            'phone_number' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password) ,
            'isValideEmail' => '0',
        ]);
        $user->assignRole('doctor');
        $selectedspeciality = $request->input('specialities');
        $serializedspeciality = serialize($selectedspeciality);

        Parametre::create([
            'doctor_id' => $user->id,
            'speciality_id' => $serializedspeciality,
            'tarif_consult' => 0,
        ]);
        Mail::to($user->email)->send(new AccountActiveDoctor($user));

        return redirect()->route('login')->with("success","We sent email to continue your registration");
    }

    public function active($id){
        $parametre = Parametre::where('doctor_id',$id)->first();
        $serializedSpecialities = $parametre->speciality_id;
        $selectedSpecialities = unserialize($serializedSpecialities);

        $motifs = Motif::all();
        $specialities = Speciality::whereIn('id', $selectedSpecialities)->get();
        // dd($specialities);
        return view('auth.activeAccount',compact('parametre','motifs','specialities','id'));
    }

    public function activeAccount(Request $request){
        // dd($request);
        $request->validate([
            'adresse' => 'required|min:5',
            'motifs' =>'required',
            'languages' => 'required',
            'zip_code' => 'required|min:5|max:6',
        ]);

        $selectedmotifs = $request->input('motifs');
        $serializedmotifs = serialize($selectedmotifs);

        $selectedlanguages = $request->input('languages');
        $serializedlanguages = serialize($selectedlanguages);

        $doctor = User::findOrFail($request->idDoc);
        $doctor->address = $request->adresse;
        $doctor->zip_code = $request->zip_code;
        $doctor->isValideEmail = '1';
        $doctor->update();
        $paramDoc = Parametre::where('doctor_id',$request->idDoc)->first();
        $paramDoc->language_spoken = $serializedlanguages;
        $paramDoc->motifs_id = $serializedmotifs;
        $paramDoc->update();
        return redirect()->route('login')->with("success", "Waiting for the admin to Confirme your account");

    }

}
