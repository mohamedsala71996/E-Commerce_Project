<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\RoleAbility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class RoleController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Role::class);
        $roles = Role::paginate(10);
        return view('dashboard.roles.index', compact('roles'));
    }
    public function create()
    {
        $this->authorize('create', Role::class);
        $allow = 'allow';
        $role = new Role();
        return view('dashboard.roles.create', compact('role', 'allow'));
    }

    public function store(Request $request)
    {
        $this->authorize('create', Role::class);
        $request->validate([
            'name' => 'required|string|max:255',
            'abilities' => 'required|array'
        ]);
        $role = Role::createWithAbilities($request);
        return redirect()->route('roles.index')
            ->with('success', 'Data created successfully.');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(Role $role)
    {
        $this->authorize('update', $role);
        $allow = 'allow';
        $roleAbility = $role->roleAbility()->pluck('type', 'ability')->toArray();
        return view('dashboard.roles.edit', compact('roleAbility', 'role', 'allow'));
    }

    public function update(Request $request, Role $role)
    {
        $this->authorize('update', $role);
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,' . $role->id,
            'abilities' => 'required|array'
        ]);

        $role->updateWithAbilities($request, $role);
        return redirect()->route('roles.index')
            ->with('success', 'Data updated successfully.');
    }

    public function destroy(Role $role)
    {
        $this->authorize('delete', $role);
        $role->delete();
        return redirect()->route('roles.index')
            ->with('success', 'Data deleted successfully.');
    }
}
