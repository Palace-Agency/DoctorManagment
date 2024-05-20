<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view("admin.permissions-roles.roles.index", compact('roles'));
    }

    public function create()
    {
        return view("admin.permissions-roles.roles.create");
    }

    public function store(Request $request)
    {
        $request->validate([
            'namerole' => 'required|unique:roles,name',
        ]);
        Role::create([
            'name' => $request->namerole
        ]);
        return redirect()->route('role.index')->with('success', 'the role : '.$request->namerole.' has been creates successfully');
    }

    public function edit(Role $role)
    {
        return view("admin.permissions-roles.roles.edit", compact('role'));
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'namerole' => 'required|unique:roles,name',
        ]);
        $role->name = $request->namerole;
        $role->update();
        return redirect()->route('role.index')->with('success', 'the role has been Updated successfully');
    }
    public function destroy($idrole)
    {

        $role = Role::find($idrole);
        $role->delete();
        return redirect()->route('role.index')->with('success', 'the role deleted successfuly');
    }
    public function addPermissionToRole($idrole)
    {
        $role = Role::findOrFail($idrole);
        $permissions = Permission::all();
        $rolePermissions = DB::table("role_has_permissions")
        ->where("role_has_permissions.role_id", $role->id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();
        return view('admin.permissions-roles.roles.add-permissions', compact('role', 'permissions', 'rolePermissions'));
    }
    public function givePermissionToRole(Request $request, $idrole)
    {
        $request->validate([
            "permission" => "required"
        ]);
        $role = Role::findOrFail($idrole);
        $role->syncPermissions($request->permission);

        return redirect()->back()->with('success', 'the permission added to the role with success');
    }
}
