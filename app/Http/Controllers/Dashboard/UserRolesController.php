<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;

class UserRolesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::paginate(10);
        return view('dashboard.roles.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        // $usersRoles = [];
        // foreach ($users->roles as $role) {
        //     $usersRoles[$role->name] = $role->name;
        // }
        $roles = Role::all();
        $userRolesIds=$user->roles->pluck('id')->toArray();
        return view('dashboard.roles.users.edit', compact('roles','user','userRolesIds'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $ids=$request->roles;
        $user->roles()->sync($ids);
        return redirect()->route('users.index')->with("success", "Data saved successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
