<?php

namespace App\Http\Controllers\Doctor;
use App\Models\Motif;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Parametre;
use App\Models\Picture;
use App\Models\Speciality;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class CabinetController extends Controller
{
    

    public function profile(){
        $specialities = Speciality::all();
        $doctor = User::where('id', Auth::id())->first();
        $parametres = Parametre::where('doctor_id', Auth::id())->first();
        $serializedSpecialities = $parametres->speciality_id;
        $selectedSpecialities = unserialize($serializedSpecialities);
        $serializedlanguages = $parametres->language_spoken;
        $selectedlanguages = unserialize($serializedlanguages);
        $serializedmotifs = $parametres->motifs_id;
        $selectedmotifs = unserialize($serializedmotifs);

        $pictures = Picture::where('doctor_id',Auth::id())->get();
        $motifs = Motif::all();
        return view('doctor.profile', compact('specialities', 'doctor', 'selectedSpecialities', 'selectedlanguages','parametres', 'motifs','pictures', 'selectedmotifs'));
    }

    public function store(Request $request){
        //

        $validator = Validator::make($request->all(), [
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'city_id' => 'required|exists:cities,id',
            'phone' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
            'zip_code' => 'required|string|max:255',
            'gender' => 'required|in:man,women',
            'tarif_consult' => 'nullable|numeric',
            'bio' => 'required|string|min:7',
            'experience_diplome' => 'nullable|string|min:7',
            'image' => 'nullable|image|mimes:jpeg,png,jpg',
            'head' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'pictures.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'languages' => 'required|array',
            'languages.*' => 'required|string',
            'motifs' => 'required|array', // Validates that it's an array
            'motifs.*' => 'required|string', // Validates each item in the array
            'specialities' => 'required|array', // Validates that it's an array
            'specialities.*' => 'required|string', // Validates each item in the array
        ]);

        if ($validator->fails()) {
            return response()->json(['danger' => $validator->errors()]);
        }
        $file_name = 'default.png';
        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $file_extention = $file->getClientOriginalExtension();
            $file_name = time() . '.' . $file_extention;
            $path = 'images/doctor';
            $file->move($path, $file_name);
        };
        $info_doc = User::findOrFail(Auth::user()->id);
        $info_doc->fname = $request->fname;
        $info_doc->lname = $request->lname;
        $info_doc->gender = $request->gender;
        $info_doc->city_id = $request->city_id;
        $info_doc->address = $request->adresse;
        $info_doc->zip_code = $request->zip_code;
        $info_doc->image = $file_name ;
        $info_doc->phone_number = $request->phone;
        $info_doc->save();

        $head = Parametre::where('doctor_id',Auth::id())->first();

        $file_name_head = $head->entete ?? 'default_head.png';
        if ($request->hasfile('head')) {
            $file = $request->file('head');
            $file_extention = $file->getClientOriginalExtension();
            $file_name_head = time() . '.' . $file_extention;
            $path = 'images/head';
            $file->move($path, $file_name_head);
        };

        $selectedlanguages = $request->input('languages');
        $serializedlanguages = serialize($selectedlanguages);

        $selectedmotifs = $request->input('motifs');
        $serializedmotifs = serialize($selectedmotifs);

        $selectedspecialities = $request->input('specialities');
        $serializedspecialities = serialize($selectedspecialities);
        $picturesdoctor = Picture::where('doctor_id', Auth::id())->exists();

        $imageDate =  [];
        if($files = $request->file('pictures')){
            foreach ($files as $key => $file) {
                $extension = $file->getClientOriginalExtension();
                $filename = $key.'-'.time().'.'.$extension;
                $path = "images/cabinets/";
                $file->move($path,$filename);
                $imageDate[] = [
                    'doctor_id' => Auth::id(),
                    'picture' => $path.$filename,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        Picture::insert($imageDate);

        $param_doc = Parametre::where('doctor_id',Auth::id())->first();
        $param_doc->tarif_consult = $request->tarif_consult;
        $param_doc->entete = $file_name_head;
        $param_doc->bio = $request->bio;
        $param_doc->images =  Auth::id();
        $param_doc->language_spoken = $serializedlanguages;
        $param_doc->motifs_id = $serializedmotifs;
        $param_doc->speciality_id = $serializedspecialities;
        $param_doc->experience = $request->experience_diplome;
        $param_doc->save();

        return response()->json(['success' => 'the modification saved successfully']);


    }

    public function deletePicture($idpicture){

        $doctor_image = Picture::findOrFail($idpicture);
        if(File::exists($doctor_image->picture)){
            File::delete($doctor_image->picture);
        }
        $doctor_image->delete();
        return redirect()->back()->with('success','the image has been deleted successfully');
    }

}
