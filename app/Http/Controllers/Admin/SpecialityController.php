<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Speciality;
use Illuminate\Http\Request;

class SpecialityController extends Controller
{
    public function index()
    {
        $specialities = Speciality::all();
        return view('admin.specialities-motifs.specialities.index',compact('specialities'));
    }

    public function create()
    {
        return view('admin.specialities-motifs.specialities.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'namespeciality' => 'required|string',
            'description' => 'required|min:5'
        ]);
        // dd($request);
        speciality::create([
            "name_sp" => $request->namespeciality,
            "description" => $request->description
        ]);
        return redirect()->route('speciality.index')->with('success', 'the speciality has been created successfully');
    }
    // public function addAll()
    // {
    //     $specialties = [
    //         'General Practice' => 'General practice is the medical specialty that focuses on providing comprehensive care to patients.',
    //         'Internal Medicine' => 'Internal medicine is a medical specialty that deals with diseases of the internal organs and systemic diseases.',
    //         'Pediatrics' => 'Pediatrics is the branch of medicine that focuses on the health and diseases of children, from birth to adolescence.',
    //         'Obstetrics and Gynecology' => 'Obstetrics and gynecology are two medical specialties that focus on women\'s health, including pregnancy.',
    //         'Surgery' => 'Surgery is a medical specialty that focuses on surgical interventions to treat diseases, injuries, and surgical conditions.',
    //         'Psychiatry' => 'Psychiatry is the medical specialty that deals with mental disorders, mental illnesses, and psychiatric conditions.',
    //         'Dermatology' => 'Dermatology is the medical specialty that deals with diseases of the skin, hair, nails, and mucous membranes.',
    //         'Cardiology' => 'Cardiology is the medical specialty that deals with diseases of the heart and blood vessels.',
    //         'Orthopedics' => 'Orthopedics is the medical specialty that deals with disorders of the musculoskeletal system, including bones, joints.',
    //         'Ophthalmology' => 'Ophthalmology is the medical specialty that deals with diseases and conditions of the eyes.',
    //         'Neurology' => 'Neurology is the medical specialty that deals with diseases and conditions of the nervous system, including the brain, spinal cord, and peripheral nerves.',
    //         'Gastroenterology' => 'Gastroenterology is the medical specialty that deals with diseases and conditions of the gastrointestinal system, including the stomach, intestines, liver, and pancreas.',
    //         'Oncology' => 'Oncology is the medical specialty that deals with cancer, including diagnosis, treatment, and follow-up of cancer patients.',
    //         'Radiology' => 'Radiology is the medical specialty that uses medical imaging techniques to diagnose and treat diseases and conditions.',
    //         'Anesthesiology' => 'Anesthesiology is the medical specialty that focuses on pain management, anesthesia, and sedation for surgical procedures and medical procedures.',
    //         'Urology' => 'Urology is the medical specialty that deals with diseases and conditions of the urinary system, including the kidneys, urinary tract, bladder, prostate, and male reproductive organs.',
    //         'Nephrology' => 'Nephrology is the medical specialty that deals with diseases and conditions of the kidneys.',
    //         'Endocrinology' => 'Endocrinology is the medical specialty that deals with disorders and conditions of hormones and endocrine glands.',
    //         'Allergy and Immunology' => 'Allergy and immunology are medical specialties that deal with allergies, autoimmune diseases, and disorders of the immune system.',
    //         'Pulmonology' => 'Pulmonology is the medical specialty that deals with diseases and conditions of the lungs and respiratory tract.',
    //     ];
    //     foreach ($specialties as $specialtyName => $description) {
    //         // Check if the specialty already exists to avoid duplicates
    //         if (!Speciality::where('name_sp', $specialtyName)->exists()) {
    //             // Create the specialty with its description
    //             Speciality::create([
    //                 'name_sp' => $specialtyName,
    //                 'description' => $description,
    //                 // You can add other fields if necessary
    //             ]);
    //         }
    //     }
    //     return redirect()->route('speciality.index')->with('success', 'all the speciality has been created successfully');
    // }

    public function edit($idsp){
        $speciality = Speciality::findOrFail($idsp);
        return view('admin.specialities-motifs.specialities.edit',compact('speciality'));
    }

    public function update(Request $request,$idsp){
        // dd($request);
        $request->validate([
            'namespeciality' => 'required|string',
            'description' => 'required|min:5'
        ]);
        $speciality = Speciality::findOrFail($idsp);
        $speciality->name_sp = $request->namespeciality;
        $speciality->description = $request->description;
        $speciality->update();
        return redirect()->route('speciality.index')->with('success', 'the speciality has been updated successfully');

    }

    public function destroy($idsp){
        $speciality = Speciality::find($idsp);
        $speciality->delete();
        return redirect()->route('speciality.index')->with('success', 'the speciality deleted successfuly');
    }
}
