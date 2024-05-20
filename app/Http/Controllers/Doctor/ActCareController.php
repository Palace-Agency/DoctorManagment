<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\ActCare;
use App\Models\CategoryActCare;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActCareController extends Controller
{
    public function index()
    {
        $actcares = ActCare::where('doctor_id', Auth::id())->get();
        return view('doctor.actAndCare.index', compact('actcares'));
    }

    public function create()
    {
        $category_acts = CategoryActCare::where('doctor_id', Auth::id())->get();
        return view('doctor.actAndCare.create', compact('category_acts'));
    }

    public function get()
    {
        $category_acts = CategoryActCare::where('doctor_id', Auth::id())->get();
        return response()->json([$category_acts]);
    }
    public function storeCat(Request $request)
    {
        CategoryActCare::create([
            'doctor_id' => Auth::id(),
            'name' => $request->name_cat
        ]);

        return response()->json(['success' => 'the category Act & care saved successfully']);
    }
    public function storeAct(Request $request)
    {
        $request->validate([
            'nameact' => 'required',
            'name_m' => 'required',
            'category_act' => 'required',
            'honoraires' => 'required',
            'code' => 'required',
            'coefficient' => 'required',
            'status' => 'required',
        ]);

        ActCare::Create([
            'doctor_id' => Auth::id(),
            'name_act' => $request->nameact,
            'name_mutuelle' => $request->name_m,
            'cat_id' => $request->category_act,
            'honoraires' => $request->honoraires,
            'remboursement_acte' => $request->status,
            'code' => $request->code,
            'coefficient' => $request->coefficient,
        ]);
        return redirect()->route('actcare.index')->with("success", 'the act & care has been created successfully');
    }

    public function delete($idCate)
    {
        $category = CategoryActCare::findOrFail($idCate);
        $category->delete();
        return back()->with('success', 'the category has been deleted successfully');
    }

    public function deleteAct($idAct)
    {
        $actcare = ActCare::findOrFail($idAct);
        $actcare->delete();
        return back()->with('success', 'the Act & care has been deleted successfully');
    }

    public function edit($idAct){
        $category_acts = CategoryActCare::where('doctor_id', Auth::id())->get();

        $actcare = ActCare::findOrFail($idAct);
        return view('doctor.actAndCare.edit',compact('actcare','category_acts'));
    }

    public function update(Request $request,$idAct){
        $request->validate([
            'nameact' => 'required',
            'name_m' => 'required',
            'category_act' => 'required',
            'honoraires' => 'required',
            'code' => 'required',
            'coefficient' => 'required',
            'status' => 'required',
        ]);


        $actcare = ActCare::findOrFail($idAct);
        $actcare->doctor_id = Auth::id();
        $actcare->name_act = $request->nameact;
        $actcare->name_mutuelle = $request->name_m;
        $actcare->cat_id = $request->category_act;
        $actcare->honoraires = $request->honoraires;
        $actcare->remboursement_acte = $request->status;
        $actcare->code = $request->code;
        $actcare->coefficient = $request->coefficient;
        $actcare->save();
        return redirect()->route('actcare.index')->with('success', 'the Act & care has been update successfully');

    }
}
