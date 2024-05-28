<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\CategoryExpense;
use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
{
    public function index(){
        $expenses = Expense::with('categoryExpense:id,name')->where('doctor_id',Auth::user()->id)->get();


        return view('doctor.expenses.index',compact('expenses'));
    }

    public function create(){
        $categoryexps = CategoryExpense::where('doctor_id',Auth::user()->id)->get();
        return view('doctor.expenses.create',compact('categoryexps'));
    }
    public function store(Request $request){
        $request->validate([
            'category_expenses_id' => 'required',
            'name' => 'required',
            'description' => 'required|min:5',
            'status' => 'required',
            'amount' => 'required|numeric',
        ]);
        Expense::create([
            'name' => $request->name,
            'description' => $request->description,
            'status' => $request->status,
            'amount' => $request->amount,
            'doctor_id'=>Auth::user()->id,
            'category_expense_id' => $request->category_expenses_id,
        ]);
        return to_route('expense.index')->with('success', 'Your Expense has been created successfully');
    }

    public function edit(  $id){
        $categoryexps = CategoryExpense::where('doctor_id', Auth::user()->id)->get();
        $expense = Expense::where('doctor_id', Auth::user()->id)->where('id',$id)->first();
        return view('doctor.expenses.edit',compact('expense', 'categoryexps'));
    }
    public function update(Request $request,$id){

        $request->validate([
            'category_expenses_id' => 'required',
            'name' => 'required',
            'description' => 'required|min:5',
            'status' => 'required',
            'amount' => 'required|numeric',
        ]);
        $expense = Expense::findOrFail($id);
        $expense->doctor_id=Auth::user()->id;

        $expense->name = $request->name;
        $expense->description = $request->description;
        $expense->category_expense_id = $request->category_expenses_id;
        $expense->status = $request->status;
        $expense->amount = $request->amount;
        $expense->update();
        return to_route('expense.index')->with('success', 'Your Expense has been Updated successfully');
    }

    public function status(Request $request, $id)
    {
        $expense = Expense::findOrFail($id);
        $expense->status = $request->status;
        $expense->update();
        return redirect()->route('expense.index')->with('success', 'You changed Status of ' . $expense->name . ' successfuly');
    }
    public function delete($id)
    {
        $categoryexp = Expense::findOrFail($id);
        $categoryexp->delete();
        return to_route('categoryexpense.index')->with('success', 'Your category expense has been deleted');
    }
}
