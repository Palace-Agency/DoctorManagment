<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    public function index(){
        $employees = User::where('doctor_id',Auth::id())->get();
        return view('doctor.employee.index',compact('employees'));
    }

    public function create(){
        $cities = City::all();
        return view('doctor.employee.create',compact('cities'));
    }
    public function store(Request $request){
        // dd($request);
        $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            'city_id' => 'required',
            'phone' => 'required',
            'adresse' => 'required|min:5|max:40',
            'gender' => 'required',
            'salary' => 'required',
            'zip_code' => 'required|min:5|max:6',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|max:20|confirmed',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4048',
        ]);
        $file_name = 'default.png';
        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $file_extention = $file->getClientOriginalExtension();
            $file_name = time() . '.' . $file_extention;
            $path = 'images/employee';
            $file->move($path, $file_name);
        };
        $user = User::create([
            'fname' => $request->fname,
            'doctor_id'=>Auth::id(),
            'lname' => $request->lname,
            'gender' => $request->gender,
            'address' => $request->adresse,
            'city_id' => $request->city_id,
            'zip_code' => $request->zip_code,
            'salary' => $request->salary,
            'image' => $file_name,
            'phone_number' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $user->assignRole('employee');
        return redirect()->route('employee.index')->with("success", "the account has been created successfully");

    }

    public function statusChange(Request $request , $idemployee){
        // dd($request);
        $employee = User::findOrFail($idemployee);
        $employee->isActive = $request->status ;
        $employee->update();
        return redirect()->route('employee.index')->with("success","the employee " . $employee->lname . " his status change successfully");

    }

    public function edit($idemployee){
        $employee = User::findOrFail($idemployee);
        return view('doctor.employee.edit',compact('employee'));
    }

    public function update(Request $request,$idemployee){
        $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            'city_id' => 'required',
            'phone' => 'required',
            'adresse' => 'required|min:5|max:40',
            'gender' => 'required',
            'salary' => 'required',
            'zip_code' => 'required|min:5|max:6',
            'password' => 'required|min:8|max:20|confirmed',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4048',
        ]);
        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $file_extention = $file->getClientOriginalExtension();
            $file_name = time() . '.' . $file_extention;
            $path = 'images/employee';
            $file->move($path, $file_name);
        };
        $user = User::findOrFail($idemployee);
        $user->fname = $request->fname;
        $user->lname = $request->lname;
        $user->gender = $request->gender;
        $user->address = $request->adresse;
        $user->city_id = $request->city_id;
        $user->salary = $request->salary;
        $user->zip_code = $request->zip_code;
        $user->image = $file_name ?? $user->image;
        $user->phone_number = $request->phone;
        $user->password = Hash::make($request->password);
        $user->update();
        // $user->assignRole('employee');
        return redirect()->route('employee.index')->with("success", "the account has been updated successfully");

    }

    public function delete($idemployee){
        $user = User::findOrFail($idemployee);
        $user->delete();
        return redirect()->route('employee.index')->with("success", "the account has been deleted successfully");
    }

    public function givePermissions($idemployee){
        $employee = User::findOrFail($idemployee);
        $permissions = Permission::all();
        $modelPermissions = DB::table("model_has_permissions")
        ->where("model_has_permissions.model_id", $employee->id)
            ->pluck('model_has_permissions.permission_id', 'model_has_permissions.permission_id')
            ->all();
        return view('doctor.employee.add-permissions', compact('permissions','employee', 'modelPermissions'));
    }

    public function givePermissionsStore(Request $request ,$idemployee){
        $request->validate([
            "permission" => "required"
        ]);
        $employee = User::findOrFail($idemployee);
        $employee->givePermissionTo($request->permission);
        return redirect()->back()->with('success', 'the permission added to the role with success');

    }
}
