<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;

use App\Models\Ordonnance;
use App\Models\Pharmacy_med;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class OrdonnanceController extends Controller
{
    public function ordonnanceStore(Request $request,$idpatient){
        // dd($request);
        $validator = Validator::make($request->all(), [
            'remarque' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['danger' =>'remarque is required']);
        }

        $ord = Ordonnance::create([
            'patient_id'=> $idpatient,
            'doctor_id'=> Auth::id(),
            'type_ordonnance'=> $request->type_ordonance,
            'remarque'=> $request->remarque,

        ]);

        foreach ($request->medicament as $medData) {
            Pharmacy_med::create([
                'medicament' => $medData['medicament'],
                'treatment' => $medData['treatment'],
                'id_ordonnance' => $ord->id,
            ]);
        }


        return response()->json(['success' => 'the ordonnance has been created successfully']);
    }

    public function ordonnanceGet($id){
        $ordonnances = Ordonnance::where('doctor_id',Auth::id())->where('patient_id',$id)->get();
        return response()->json($ordonnances);
    }

    public function delete($id){
        $pharmacie_med = Pharmacy_med::where('id', $id)->first();
        if($pharmacie_med){
            $pharmacie_med->delete();
        }
        $ordonnance = Ordonnance::findOrFail($id);
        $ordonnance->delete();
        return back()->with('success', 'the Ordonnance has been deleted successfully');

    }

    public function getOrdonnanceId($idordonnance){
        $ordonnanceGet = Ordonnance::findOrFail($idordonnance);
        $med_pharmacie = Pharmacy_med::where('id_ordonnance',$idordonnance)->get();
        return response()->json([$ordonnanceGet,$med_pharmacie]);
    }

    public function generatePdf($idordonnance)
    {
        // dd($idordonnance);
        $ordonnance = Ordonnance::findOrFail($idordonnance);
        $patient = User::role('patient')->where('id', $ordonnance->patient_id)->first();
        $doctor = User::role('doctor')->with('parametre')->where('id', $ordonnance->doctor_id)->first();
        $pharmacy_med = Pharmacy_med::where('id_ordonnance', $ordonnance->id)->get();
        // dd($pharmacy_med);
        $pdf = PDF::loadView('/doctor/mypatient/pdfOrdonnance', compact('patient', 'doctor','ordonnance','pharmacy_med'));
        return $pdf->download($patient->fname.' '.$patient->lname. '.pdf');
        // return view( 'doctor.mypatient.pdfOrdonnance', compact('patient', 'doctor','ordonnance', 'pharmacy_med'));
    }
}
