<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Motif;
use App\Models\Parametre;
use App\Models\Speciality;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DoctorController extends Controller
{
    public function index(){
        $doctors = User::all();
        return view('admin.users.doctors.index',compact('doctors'));
    }

    public function create(){
        $specialities = Speciality::all();
        return view('admin.users.doctors.create',compact('specialities'));
    }

    public function store(Request $request){
        $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            'city_id' => 'required',
            'phone' => 'required',
            'adresse' => 'required|min:5|max:40',
            'specialities' => 'required',
            'languages' => 'required',
            'gender' => 'required',
            'zip_code' => 'required|min:5|max:6',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|max:16|confirmed',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4048',
        ]);

        $selectedlanguages = $request->input('languages');
        $serializedlanguages = serialize($selectedlanguages);
        $file_name = 'default.png';
        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $file_extention = $file->getClientOriginalExtension();
            $file_name = time() . '.' . $file_extention;
            $path = 'images/doctor';
            $file->move($path, $file_name);
        };
        $user = User::create([
            'fname' => $request->fname,
            'lname' => $request->lname,
            'gender' => $request->gender,
            'address' => $request->adresse,
            'city_id' => $request->city_id,
            'zip_code' => $request->zip_code,
            'image' => $file_name,
            'phone_number' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $user->assignRole('doctor');
        $selectedspeciality = $request->input('specialities');
        $serializedspeciality = serialize($selectedspeciality);

        // $selectedSpecialityIds = $request->input('specialities');
        Parametre::create([
            'doctor_id' => $user->id,
            'language_spoken' => $serializedlanguages,
            'speciality_id' => $serializedspeciality,

        ]);

        return redirect()->route('doctor.index')->with("success", "the account is created waiting for the admin to activate the account");
    }

    public function edit($iddoctor){
        $specialities = Speciality::all();
        $doctor = User::where('id', $iddoctor)->first();
        $parametres = Parametre::where('doctor_id', $iddoctor)->first();
        $serializedSpecialities = $parametres->speciality_id;
        $selectedSpecialities = unserialize($serializedSpecialities);
        $serializedlanguages = $parametres->language_spoken;
        $selectedlanguages = unserialize($serializedlanguages);
        $motifs = Motif::all();
        return view('admin.users.doctors.edit', compact('specialities' ,'doctor','selectedSpecialities', 'selectedlanguages','motifs'));
    }

    public function update(Request $request,$iddoctor){
        $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            'city_id' => 'required',
            'phone' => 'required',
            'adresse' => 'required|min:5',
            'specialities' => 'required',
            'languages' => 'required',
            'motifs' => 'required|array|min:1',
            'gender' => 'required',
            'zip_code' => 'required|min:5|max:6',
            'password' => 'required|min:8|confirmed',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'

        ]);
        $currentImage = User::findOrFail($iddoctor);
        $file_name = $currentImage->image;
        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $file_extention = $file->getClientOriginalExtension();
            $file_name = time() . '.' . $file_extention;
            $path = 'images/doctor';
            $file->move($path, $file_name);
        };

        $user = User::findOrFail($iddoctor);
        $user->fname = $request->input('fname');
        $user->lname = $request->input('lname');
        $user->city_id = $request->input('city_id');
        $user->phone_number = $request->input('phone');
        $user->address = $request->input('adresse');
        $user->gender = $request->input('gender');
        $user->zip_code = $request->input('zip_code');
        $user->image = $file_name;
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));

        // Save the updated user information
        $user->assignRole('doctor');
        $user->save();

        $selectedlanguages = $request->input('languages');
        $serializedlanguages = serialize($selectedlanguages);

        $selectedspeciality = $request->input('specialities');
        $serializedspeciality = serialize($selectedspeciality);
        $selectedmotifs = $request->input('motifs');
        $serializedmotifs = serialize($selectedmotifs);

        $parametre = Parametre::where('doctor_id', $iddoctor)->first();
        $parametre->language_spoken = $serializedlanguages ?? $parametre->language_spoken;
        $parametre->speciality_id = $serializedspeciality ?? $parametre->speciality_id;
        $parametre->motifs_id = $serializedmotifs ?? $parametre->motifs_id;
        $parametre->update();
        return redirect()->route('doctor.index')->with("success", "the account is Updated successfully");

    }

    public function status(Request $request, $iddoctor)
    {
        $doctor = User::findOrFail($iddoctor);
        $doctor->isActive = $request->status;
        $doctor->update();
        return redirect()->route('doctor.index')->with('success', 'You changed Status of ' . $doctor->name . ' successfuly');
    }


    public function destroy($iddoctor){
        // dd($iddoctor);
        $user = User::find($iddoctor);
        $param = Parametre::where('doctor_id',$iddoctor);
        $user->delete();

        $param->delete();
        return redirect()->route('doctor.index')->with('success', 'the Doctor has been deleted successfuly');


    }
}
