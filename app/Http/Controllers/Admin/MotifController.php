<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Motif;
use App\Models\Speciality;
use Illuminate\Http\Request;

class MotifController extends Controller
{
    public function index(){
        $motifs = Motif::all();
        return view('admin.specialities-motifs.motifs.index',compact('motifs'));

    }

    public function create(){
        $specialities = Speciality::all();
        return view('admin.specialities-motifs.motifs.create', compact('specialities'));
    }

    public function store(Request $request){
        // dd($request);

        $request->validate([
            'sp_id' => 'required',
            'namemotif' => 'required',
            'description' =>'required|min:8'
        ]);
        // dd($request);
        Motif::create([
            "speciality_id" => $request->sp_id,
            "nom_motif" => $request->namemotif,
            "description" => $request->description
        ]);
        return redirect()->route('motif.index')->with('success', 'the motif has been created successfully');
    }

    public function edit($idm){
        $motif = Motif::findOrFail($idm);
        $specialities = Speciality::all();

        return view('admin.specialities-motifs.motifs.edit', compact('motif','specialities'));
    }
    public function update(Request $request,$idm){

        // dd($request);
        $request->validate([
            'sp_id' => 'required',
            'namemotif' => 'required',
            'description' =>'required|min:8'
        ]);
        $motif = Motif::findOrFail($idm);
        $motif->speciality_id = $request->sp_id;
        $motif->nom_motif = $request->namemotif;
        $motif->description = $request->description;
        $motif->update();
        return redirect()->route('motif.index')->with('success', 'the motif has been Updated successfully');
    }




    public function destroy($idm){
        $motif = Motif::find($idm);
        $motif->delete();
        return redirect()->route('motif.index')->with('success', 'the motif deleted successfuly');
    }

    // public function getAll(){
    //     $motifs = [
    //         // General Practice
    //         [
    //             'speciality_id' => 1, // ID of General Practice specialty
    //             'nom_motif' => 'General Consultation',
    //             'description' => 'Medical consultation for general assessment of patient health.',
    //         ],
    //         [
    //             'speciality_id' => 1,
    //             'nom_motif' => 'Follow-up Consultation',
    //             'description' => 'Regular medical follow-up for patients with chronic conditions or medical history.',
    //         ],
    //         // Internal Medicine
    //         [
    //             'speciality_id' => 2, // ID of Internal Medicine specialty
    //             'nom_motif' => 'Assessment of General Symptoms',
    //             'description' => 'Assessment of nonspecific symptoms to determine underlying causes.',
    //         ],
    //         [
    //             'speciality_id' => 2,
    //             'nom_motif' => 'Chronic Disease Follow-up',
    //             'description' => 'Regular medical follow-up for patients with chronic diseases such as diabetes or hypertension.',
    //         ],
    //         // Pediatrics
    //         [
    //             'speciality_id' => 3, // ID of Pediatrics specialty
    //             'nom_motif' => 'Follow-up Visit for Growth and Development',
    //             'description' => 'Regular medical visit to monitor the growth and development of the child.',
    //         ],
    //         [
    //             'speciality_id' => 3,
    //             'nom_motif' => 'Vaccinations',
    //             'description' => 'Administration of vaccines recommended according to the vaccination schedule.',
    //         ],
    //         [
    //             'speciality_id' => 4, // ID of Obstetrics and Gynecology specialty
    //             'nom_motif' => 'Prenatal Consultation',
    //             'description' => 'Medical visit for pregnancy monitoring and the well-being of the mother and fetus.',
    //         ],
    //         [
    //             'speciality_id' => 4,
    //             'nom_motif' => 'Follow-up Ultrasound for Pregnancy',
    //             'description' => 'Ultrasound to assess the growth and development of the fetus during pregnancy.',
    //         ],
    //         [
    //             'speciality_id' => 5, // ID of Surgery specialty
    //             'nom_motif' => 'Preoperative Consultation',
    //             'description' => 'Medical consultation before a surgical procedure to assess the patient\'s health and prepare for the intervention.',
    //         ], [
    //             'speciality_id' => 5,
    //             'nom_motif' => 'Postoperative Follow-up',
    //             'description' => 'Medical visit after a surgical procedure to monitor healing and prevent complications.',
    //         ],
    //         // Psychiatry
    //         [
    //             'speciality_id' => 6, // ID of Psychiatry specialty
    //             'nom_motif' => 'Assessment of Mood Disorders',
    //             'description' => 'Assessment of symptoms of depression, anxiety, and bipolar disorders.',
    //         ],
    //         [
    //             'speciality_id' => 6,
    //             'nom_motif' => 'Cognitive-Behavioral Therapy',
    //             'description' => 'Therapy to treat mental disorders by modifying thought patterns and behaviors.',
    //         ], [
    //             'speciality_id' => 7, // ID of Dermatology specialty
    //             'nom_motif' => 'Skin Condition Evaluation',
    //             'description' => 'Evaluation and treatment of skin conditions such as acne, eczema, and psoriasis.',
    //         ],
    //         [
    //             'speciality_id' => 7,
    //             'nom_motif' => 'Skin Cancer Screening',
    //             'description' => 'Examination of the skin to detect signs of skin cancer and other skin abnormalities.',
    //         ],
    //         // Cardiology
    //         [
    //             'speciality_id' => 8, // ID of Cardiology specialty
    //             'nom_motif' => 'Cardiac Evaluation',
    //             'description' => 'Evaluation and treatment of heart conditions such as arrhythmias, heart failure, and coronary artery disease.',
    //         ],
    //         [
    //             'speciality_id' => 8,
    //             'nom_motif' => 'Heart Disease Prevention',
    //             'description' => 'Guidance and interventions to prevent heart disease and promote heart health.',
    //         ],
    //         // Orthopedics
    //         [
    //             'speciality_id' => 9, // ID of Orthopedics specialty
    //             'nom_motif' => 'Orthopedic Consultation',
    //             'description' => 'Evaluation and treatment of musculoskeletal conditions such as fractures, sprains, and arthritis.',
    //         ],
    //         [
    //             'speciality_id' => 9,
    //             'nom_motif' => 'Orthopedic Surgery Assessment',
    //             'description' => 'Assessment and preparation for orthopedic surgical procedures.',
    //         ], [
    //             'speciality_id' => 10, // ID of Ophthalmology specialty
    //             'nom_motif' => 'Eye Examination',
    //             'description' => 'Comprehensive evaluation of eye health and vision.',
    //         ],
    //         [
    //             'speciality_id' => 10,
    //             'nom_motif' => 'Treatment of Eye Conditions',
    //             'description' => 'Management and treatment of eye conditions such as cataracts, glaucoma, and macular degeneration.',
    //         ],
    //         // Neurology
    //         [
    //             'speciality_id' => 11, // ID of Neurology specialty
    //             'nom_motif' => 'Neurological Evaluation',
    //             'description' => 'Assessment and treatment of neurological conditions such as headaches, seizures, and strokes.',
    //         ],
    //         [
    //             'speciality_id' => 11,
    //             'nom_motif' => 'Neurological Testing',
    //             'description' => 'Diagnostic testing such as EEG and MRI to evaluate neurological disorders.',
    //         ],
    //         // Gastroenterology
    //         [
    //             'speciality_id' => 12, // ID of Gastroenterology specialty
    //             'nom_motif' => 'Digestive System Evaluation',
    //             'description' => 'Evaluation and treatment of digestive disorders such as gastritis, ulcers, and irritable bowel syndrome.',
    //         ],
    //         [
    //             'speciality_id' => 12,
    //             'nom_motif' => 'Endoscopic Procedures',
    //             'description' => 'Diagnostic and therapeutic procedures such as endoscopy and colonoscopy.',
    //         ], [
    //             'speciality_id' => 13, // ID of Oncology specialty
    //             'nom_motif' => 'Cancer Diagnosis and Staging',
    //             'description' => 'Evaluation, diagnosis, and staging of cancerous tumors.',
    //         ],
    //         [
    //             'speciality_id' => 13,
    //             'nom_motif' => 'Chemotherapy Treatment',
    //             'description' => 'Administration of chemotherapy drugs for cancer treatment.',
    //         ],
    //         // Radiology
    //         [
    //             'speciality_id' => 14, // ID of Radiology specialty
    //             'nom_motif' => 'Diagnostic Imaging',
    //             'description' => 'Diagnostic imaging procedures such as X-rays, CT scans, and MRI scans.',
    //         ],
    //         [
    //             'speciality_id' => 14,
    //             'nom_motif' => 'Interventional Radiology Procedures',
    //             'description' => 'Minimally invasive procedures guided by imaging techniques for diagnosis and treatment.',
    //         ],
    //         // Anesthesiology
    //         [
    //             'speciality_id' => 15, // ID of Anesthesiology specialty
    //             'nom_motif' => 'Preoperative Anesthesia Evaluation',
    //             'description' => 'Assessment and planning of anesthesia administration before surgery.',
    //         ],
    //         [
    //             'speciality_id' => 15,
    //             'nom_motif' => 'Intraoperative Anesthesia Management',
    //             'description' => 'Monitoring and management of anesthesia during surgical procedures.',
    //         ], [
    //             'speciality_id' => 16, // ID of Urology specialty
    //             'nom_motif' => 'Urinary Tract Infection (UTI) Evaluation',
    //             'description' => 'Evaluation and treatment of urinary tract infections.',
    //         ],
    //         [
    //             'speciality_id' => 16,
    //             'nom_motif' => 'Prostate Examination',
    //             'description' => 'Evaluation of the prostate gland for abnormalities or conditions such as prostatitis or benign prostatic hyperplasia (BPH).',
    //         ],
    //         // Nephrology
    //         [
    //             'speciality_id' => 17, // ID of Nephrology specialty
    //             'nom_motif' => 'Chronic Kidney Disease Management',
    //             'description' => 'Management of chronic kidney disease (CKD) and its complications.',
    //         ],
    //         [
    //             'speciality_id' => 17,
    //             'nom_motif' => 'Dialysis Access Management',
    //             'description' => 'Evaluation and management of vascular access for dialysis treatment.',
    //         ],
    //         // Endocrinology
    //         [
    //             'speciality_id' => 18, // ID of Endocrinology specialty
    //             'nom_motif' => 'Thyroid Disorder Evaluation',
    //             'description' => 'Evaluation and treatment of thyroid disorders such as hypothyroidism, hyperthyroidism, and thyroid nodules.',
    //         ],
    //         [
    //             'speciality_id' => 18,
    //             'nom_motif' => 'Diabetes Management',
    //             'description' => 'Management and treatment of diabetes mellitus and its complications.',
    //         ],   [
    //             'speciality_id' => 19, // ID of Allergy and Immunology specialty
    //             'nom_motif' => 'Allergy Testing',
    //             'description' => 'Testing for allergies to identify specific allergens triggering allergic reactions.',
    //         ],
    //         [
    //             'speciality_id' => 19,
    //             'nom_motif' => 'Immunotherapy',
    //             'description' => 'Treatment for allergies by desensitizing the immune system to allergens.',
    //         ],
    //         // Pulmonology
    //         [
    //             'speciality_id' => 20, // ID of Pulmonology specialty
    //             'nom_motif' => 'Respiratory Symptoms Evaluation',
    //             'description' => 'Evaluation and treatment of respiratory symptoms such as cough, shortness of breath, and wheezing.',
    //         ],
    //         [
    //             'speciality_id' => 20,
    //             'nom_motif' => 'Asthma Management',
    //             'description' => 'Management and treatment of asthma including medication and lifestyle interventions.',
    //         ],

    //     ];
    //     // Loop through the motifs array and create a Motif instance for each
    //     foreach ($motifs as $motifData) {
    //         Motif::create($motifData);
    //     }
    //     return redirect()->route('motif.index')->with('success', 'the reasons has been created successfully');


    // }
}
