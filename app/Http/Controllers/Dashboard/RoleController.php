<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\RoleAbility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class RoleController extends Controller
{

   public function __construct()
    {
        // $this->authorizeResource(Role::class,'id');//if parameter is id in controller
        // $this->authorizeResource(Role::class,'role');//if parameter is object in controller //if no policy for this model it will return false that no abilities fot it 
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny',Role::class);
        // Gate::authorize('role.view');

        $roles = Role::paginate(10);
        return view('dashboard.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create',Role::class);

        // Gate::authorize('role.create');

        $allow = 'allow';

        $role = new Role();
        return view('dashboard.roles.create', compact('role', 'allow'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create',Role::class);

        $request->validate([
            'name' => 'required|string|max:255',
            'abilities' => 'required|array'
        ]);
        $role=Role::createWithAbilities($request);
        // $role =  Role::create([
        //     'name' => $request->name,
        // ]);

        // foreach ($request->abilities as $key => $value) {
        //     RoleAbility::create([
        //         'role_id' => $role->id,
        //         'ability' => $key,
        //         'type' => $value,
        //     ]);
        // }

        return redirect()->route('roles.index')
            ->with('success', 'Data created successfully.');
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
    public function edit(Role $role)
    {
        $this->authorize('update',$role);
        // Gate::authorize('role.update');
        $allow = 'allow';
        $roleAbility = $role->roleAbility()->pluck('type', 'ability')->toArray();
        return view('dashboard.roles.edit', compact('roleAbility', 'role','allow'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $this->authorize('update',$role);

        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,' . $role->id,
            'abilities' => 'required|array'
        ]);

        $role->updateWithAbilities($request, $role);
        // $role->update([
        //     'name' => $request->name,
        // ]);

        // foreach ($request->abilities as $key => $value) {
        //     $role->roleAbility()->updateOrCreate([
        //         'role_id' => $role->id,
        //         'ability' => $key,
        //     ], [

        //         'type' => $value,
        //     ]);
        // }

        return redirect()->route('roles.index')
            ->with('success', 'Data updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $this->authorize('delete',$role);

        // Gate::authorize('role.delete');

        $role->delete();
        return redirect()->route('roles.index')
            ->with('success', 'Data deleted successfully.');
    }
}
