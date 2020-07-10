<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Permission\Role;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Gate::authorize('haveaccess');

        // Using query builder.
        $users = \DB::table('users as u')
          ->select('u.id', 'u.name', 'u.email', 'r.name as role')
          ->leftJoin('role_user as r_u', 'u.id', '=', 'r_u.user_id')
          ->leftJoin('roles as r', 'r.id', '=', 'r_u.role_id')
          ->orderBy('u.name', 'asc')
          ->paginate(10);

        return view('user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Gate::authorize('haveaccess');

        $method = 'create';

        // Load user/createOrEditOrShow.blade.php view
        return view('user.createOrEditOrShow', compact('method'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Gate::authorize('haveaccess');

        $request->validate([
            'name'          => 'required|max:50|unique:users,name',
            'email'          => 'required|max:50|unique:users,email'
        ]);
        $user = Role::create(
            $request->all()
        );
        return redirect()->route('user.index')->with('status_success', 'User saved successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Gate::authorize('haveaccess');

        $method = 'show';

        // Using query builder.
        $user = \DB::table('users as u')
          ->select('u.id', 'u.name', 'u.email', 'r.name as role')
          ->leftJoin('role_user as r_u', 'u.id', '=', 'r_u.user_id')
          ->leftJoin('roles as r', 'r.id', '=', 'r_u.role_id')
          ->where('u.id', $id)
          ->first();

        // Load user/createOrEditOrShow.blade.php view
        return view('user.createOrEditOrShow', compact('user', 'method'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //Gate::authorize('haveaccess');

        $method = 'edit';

        // Using query builder.
        $user = \DB::table('users as u')
          ->select('u.id', 'u.name', 'u.email', 'r.name as role')
          ->leftJoin('role_user as r_u', 'u.id', '=', 'r_u.user_id')
          ->leftJoin('roles as r', 'r.id', '=', 'r_u.role_id')
          ->where('u.id', $id)
          ->first();

        $roles = \DB::table('roles as r')
          ->select('r.id', 'r.name')
          ->orderBy('r.name', 'asc')
          ->get();

        // Load user/createOrEditOrShow.blade.php view
        return view('user.createOrEditOrShow', compact('user', 'roles', 'method'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Permission\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //Gate::authorize('haveaccess');

        $request->validate([
            'name'          => 'required|max:50|unique:users,name,' . $user->id,
            'email'         => 'required|max:50|unique:users,email,' . $user->id,
        ]);
        $user->update(
            $request->all()
        );
        $user->roles()->sync($request->get('roles'));
        return redirect()->route('user.index')->with('status_success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Permission\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //Gate::authorize('haveaccess');

        // @todo controlar que elimine si usuario no es 
        // el actual
        $user->delete();
        return redirect()->route('user.index')->with('status_success', 'User successfully removed.');
    }
}
