<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\City;
use App\Models\Motif;
use App\Models\Parametre;
use App\Models\Picture;
use App\Models\Speciality;
use App\Models\User;
use App\Models\Vacation;
use App\Models\WorkingHour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Contracts\Role;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $doctors = User::where('isActive',"1")->role('doctor')->get();
        return view('landing-page',compact('doctors'));
    }

    public function doctorProfile($idDoctor){

        $doctor = User::where('id',$idDoctor)->role('doctor')->first();
        $parametre = Parametre::where('doctor_id', $idDoctor)->first();
        // dd($parametre);
        // dd($idDoctor);
        $serializedSpecialities = $parametre->speciality_id;
        $selectedSpecialities = unserialize($serializedSpecialities);

        $serializedlanguages = $parametre->language_spoken;
        $selectedlanguages = unserialize($serializedlanguages);

        $serializedmotifs = $parametre->motifs_id;
        $selectedmotifs = unserialize($serializedmotifs);
        $difftime = Parametre::where('doctor_id', $idDoctor)->first();
        $appointments = Appointment::where('doctor_id', $idDoctor)->where('status' ,'!=','cancelled')->get();
        $motifs = Motif::whereIn('id', $selectedmotifs)->get();
        $specialities = Speciality::whereIn('id', $selectedSpecialities)->get();
        $workhours = WorkingHour::where('doctor_id',$idDoctor)->get();
        $pictures = Picture::where('doctor_id', $idDoctor)->get();
        // dd($pictures);
        $holidays = Vacation::where('doctor_id',$idDoctor)->get();
        return view('doctor-profile',compact('doctor','parametre','specialities', 'selectedlanguages','motifs','workhours','holidays','difftime', 'appointments', 'pictures'));

    }

    public function specialityListAjax(){
        $specialities = Speciality::select('name_sp')->get();
        $date = [];
        foreach($specialities as $item){
            $data[] = $item['name_sp'];
        }
        return $data;
    }
    public function cityListAjax(){
        $cities = City::select('nom_city')->get();
        $date = [];
        foreach($cities as $item){
            $data[] = $item['nom_city'];
        }
        return $data;
    }

    public function searchDoctor(Request $request)
    {
        if ($request->speciality != "" && $request->city) {
            $speciality = Speciality::where('name_sp', $request->speciality)->first();
            $city = City::where('nom_city', $request->city)->first();

            if ($speciality && $city) {
                $doctors = [];
                $parametres = Parametre::all();

                foreach ($parametres as $param) {
                    $serializedSpecialities = $param->speciality_id;
                    $selectedSpecialities = unserialize($serializedSpecialities);
                    $doctorfind = User::find($param->doctor_id);

                    if ($doctorfind && in_array($speciality->id, $selectedSpecialities) && $doctorfind->city->nom_city == $request->city) {
                        $doctors[] = $doctorfind;
                    }
                }


                    return view('results', compact('doctors'));

            } else {
                return redirect()->back()->with('danger', 'Speciality or City not found');
            }
        } else {
            return redirect()->back()->with('danger', 'Please provide both speciality and city');
        }
    }


    public function allDoctors(){
        $doctors = User::role('doctor')->where('isActive','1')->get();
        return view('listDoctor',compact('doctors'));
    }

    // public function createAdmin()
    // {
    //     // Create a new user with admin role
    //     $user = User::create([
    //         'fname' => 'Admin',
    //         'lname' => 'Admin',
    //         'gender' =>'man',
    //         'image' => 'default.png',
    //         'email' => 'admin@gmail.com',
    //         'phone_number'=> '0648392040',
    //         'city_id' => 2,
    //         'password' => Hash::make('admin@gmail.com'), // Change 'password' to the desired password
    //     ]);

    //     // Assign the 'admin' role to the user
    //     $user->assignRole('admin');

    //     return 'Admin account created successfully.';
    // }
}
