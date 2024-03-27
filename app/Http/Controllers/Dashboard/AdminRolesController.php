<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Role;
use Illuminate\Http\Request;

class AdminRolesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admins = Admin::paginate(10);
        return view('dashboard.roles.admins.index', compact('admins'));
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
    public function edit(Admin $admin)
    {
        $roles = Role::all();
        $adminRolesIds = $admin->roles->pluck('id')->toArray();
        return view('dashboard.roles.admins.edit', compact('roles', 'admin', 'adminRolesIds'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Admin $admin)
    {
        $ids = $request->roles;
        $admin->roles()->sync($ids);
        return redirect()->route('admins.index')->with("success", "Data saved successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
