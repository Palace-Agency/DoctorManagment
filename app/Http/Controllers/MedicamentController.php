<?php

namespace App\Http\Controllers;

use App\Imports\MedicamentImport;
use App\Models\Medicament;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class MedicamentController extends Controller
{
    public function index(){
        $medicaments = Medicament::all();
        return view('admin.medicament.index',compact('medicaments'));
    }

    public function create(){
        return view('admin.medicament.import');
    }

    public function import(Request $request){
        $request->validate([
            'import_file' => 'required|file'
        ]);
        Excel::import(new MedicamentImport, $request->file('import_file'));
    }
}
