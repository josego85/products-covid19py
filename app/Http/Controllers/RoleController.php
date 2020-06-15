<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permission\Role;
// use App\ModelsPermission\Permission;
use Illuminate\Support\Facades\Gate;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Gate::authorize('haveaccess', 'role.index');

        $roles = Role::orderBy('id', 'Desc')->paginate(10);
        return view('roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Gate::authorize('haveaccess', 'role.create');

        //$permissions = Permission::get();
        $permissions = array();
        return view('roles.create', compact('permissions'));;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Gate::authorize('haveaccess', 'role.create');

        $request->validate([
            'name'          => 'required|max:50|unique:roles,name',
            'slug'          => 'required|max:50|unique:roles,slug',
            'full-access'   => 'required|in:yes,no'
        ]);
        $role = Role::create(
            $request->all()
        );
        //$role->permissions()->sync($request->get('permission'));
        return redirect()->route('roles.index')->with('status_success', 'Rol guardado con éxito.');
    }

    /**
     * Display the specified resource.
     *
     * @param  App\Permission\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        $this->authorize('haveaccess', 'roles.show');

        $permission_role = [];
        foreach($role->permissions as $permission)
        {
            $permission_role[] = $permission->id;
        }
        $permissions = Permission::get();
        return view('roles.view', compact('permissions', 'role', 'permission_role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Permission\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $this->authorize('haveaccess', 'role.edit');

        $permission_role = [];
        foreach($role->permissions as $permission)
        {
            $permission_role[] = $permission->id;
        }
        $permissions = Permission::get();
        return view('roles.edit', compact('permissions', 'role', 'permission_role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Permission\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $this->authorize('haveaccess', 'role.edit');

        $request->validate([
            'name'          => 'required|max:50|unique:roles,name,' . $role->id,
            'slug'          => 'required|max:50|unique:roles,slug,' . $role->id,
            'full-access'   => 'required|in:yes,no'
        ]);
        $role->update(
            $request->all()
        );
        $role->permissions()->sync($request->get('permission'));
        return redirect()->route('roles.index')->with('status_success', 'Role updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Permission\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $this->authorize('haveaccess', 'role.destroy');

        $role->delete();
        return redirect()->route('roles.index')->with('status_success', 'Role successfully removed.');
    }
}
