<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index(){
        $permissions = Permission::all();
        return view("admin.permissions-roles.permissions.index",compact('permissions'));
    }

    public function create(){
        return view("admin.permissions-roles.permissions.create");
    }

    public function store(Request $request){
        $request->validate([
            'namepermission' => 'required|unique:permissions,name',
        ]);
        Permission::create([
            'name' => $request->namepermission
        ]);
        return redirect()->route('permission.index')->with('success','the permission has been creates successfully');
    }

    public function edit(Permission $permission){
        return view("admin.permissions-roles.permissions.edit", compact('permission'));
    }

    public function update(Request $request, Permission $permission){
        $request->validate([
            'namepermission' => 'required|unique:permissions,name',
        ]);
        $permission->name = $request->namepermission;
        $permission->update();
        return redirect()->route('permission.index')->with('success', 'the permission has been Updated successfully');
    }
    public function destroy($idpermission){

        $permission = Permission::find($idpermission);
        $permission->delete();
        return redirect()->route('permission.index')->with('success', 'the permission deleted successfuly');


    }
}
