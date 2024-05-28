<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\AccountPatientMail;

class PatientController extends Controller
{
    public function index(){
        $patients = User::all();
        return view('admin.users.patients.index',compact('patients'));
    }
    public function create(){
        return view('admin.users.patients.create');
    }
    public function store(Request $request){
        $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            'phone' => 'required',
            'gender' => 'required',
            'city_id' => 'required',
            'datenaiss' => 'required',
            'email' => 'required|string|email|max:255|unique:users,email'
        ]);
        // dd($request);

        $file_name = 'default.png';
        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $file_extention = $file->getClientOriginalExtension();
            $file_name = time() . '.' . $file_extention;
            $path = 'images/patient';
            $file->move($path, $file_name);
        };

        $user = User::create([
            'fname' => $request->fname,
            'lname' => $request->lname,
            'gender' => $request->gender,
            'city_id' => $request->city_id,
            'adresse' => $request->adress,
            'zip_code' => $request->zip_code,
            'phone_number' => $request->phone,
            'date_naissance' => $request->datenaiss,
            'image' => $file_name,
            'email' => $request->email,
            'password' => Hash::make('password'),
        ]);
        $user->assignRole('patient');
        Mail::to($user->email)->send(new AccountPatientMail($user));

        return redirect()->route('doctor.index')->with("success", "the account is created successfully");

    }

    public function edit($idpatient){
        $patient = User::findOrFail($idpatient);
        return view("admin.users.patients.edit",compact('patient'));
    }

    public function update(Request $request,$idpatient){
        $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            'phone' => 'required',
            'gender' => 'required',
            'city_id' => 'required',
            'datenaiss' => 'required',
            'password' => 'required|string|min:8|confirmed',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        // dd($request->image);
        $currentImage = User::findOrFail($idpatient);
        $file_name = $currentImage->image;
        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $file_extention = $file->getClientOriginalExtension();
            $file_name = time() . '.' . $file_extention;
            $path = 'images/patient';
            $file->move($path, $file_name);
        };

        $patient = User::findOrFail($idpatient);
        $patient->fname = $request->input('fname');
        $patient->lname = $request->input('lname');
        $patient->city_id = $request->input('city_id');
        $patient->phone_number = $request->input('phone');
        $patient->address = $request->input('adress');
        $patient->gender = $request->input('gender');
        $patient->zip_code = $request->input('zip_code');
        $patient->date_naissance = $request->input('datenaiss');
        $patient->image = $file_name;
        $patient->email = $request->input('email');
        $patient->password = Hash::make($request->input('password'));

        $patient->assignRole('patient');
        $patient->update();
        return redirect()->route('patient.index')->with("success", "the account is Updated successfully");

    }

    public function status(Request $request, $idpatient)
    {
        $patient = User::findOrFail($idpatient);
        $patient->isActive = $request->status;
        $patient->update();
        return redirect()->route('patient.index')->with('success', 'You changed Status of ' . $patient->name . ' successfuly');
    }

    public function destroy($idpatient){
        $patient = User::find($idpatient);
        $patient->delete();
        return redirect()->route('patient.index')->with('success', 'the Patient has been deleted successfuly');


    }
}
