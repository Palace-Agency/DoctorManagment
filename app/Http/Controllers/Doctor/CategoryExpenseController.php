<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\CategoryExpense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryExpenseController extends Controller
{
    public function index(){
        $catexps = CategoryExpense::where('doctor_id',Auth::user()->id)->get();
        return view('doctor.categoryexpenses.index',compact('catexps'));
    }

    public function create(){
        return view('doctor.categoryexpenses.create');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'description' => 'required',

        ]);

        CategoryExpense::create([
            'name' => $request->name,
            'description' => $request->description,
            'doctor_id' => Auth::user()->id,
        ]);
        // dd($request->all());
        return to_route('categoryexpense.index')->with('success', 'Your category Expense has been created successfully');
    }


    public function edit($id)
    {
        $categoryexp = Categoryexpense::find($id);
        return view('doctor.categoryexpenses.edit', compact('categoryexp'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',

        ]);
        
        $categoryexp = CategoryExpense::findOrFail($id);
        $categoryexp->name = $request->name;
        $categoryexp->description = $request->description;
        $categoryexp->doctor_id = Auth::user()->id;

        $categoryexp->update();
        return to_route('categoryexpense.index')->with('success', 'Your category expense has been updated');
    }


    public function delete($id)
    {
        $categoryexp = Categoryexpense::find($id);
        $categoryexp->delete();
        return to_route('categoryexpense.index')->with('success', 'Your category expense has been deleted');
    }
}
