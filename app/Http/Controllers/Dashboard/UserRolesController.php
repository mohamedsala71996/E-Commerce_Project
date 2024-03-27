<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;

class UserRolesController extends Controller
{
    public function index()
    {
        $users = User::paginate(10);
        return view('dashboard.roles.users.index', compact('users'));
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
        //
    }
    public function show(string $id)
    {
        //
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        $userRolesIds = $user->roles->pluck('id')->toArray();
        return view('dashboard.roles.users.edit', compact('roles', 'user', 'userRolesIds'));
    }

    public function update(Request $request, User $user)
    {
        $ids = $request->roles;
        $user->roles()->sync($ids);
        return redirect()->route('users.index')->with("success", "Data saved successfully");
    }

    public function destroy(string $id)
    {
        //
    }
}
