<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Tables\Roles;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\Facades\Splade;
use ProtoneMedia\Splade\FormBuilder\Input;
use ProtoneMedia\Splade\FormBuilder\Submit;
use ProtoneMedia\Splade\SpladeForm;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        return view('admin.roles.index', [
            'roles' => Roles::class
        ]);
    }

    public function create()
    {

        return view('admin.roles.create', [
            'permissions' => Permission::pluck('name', 'id')->toArray()
        ]);
    }
    public function store(CreateRoleRequest $request)
    {
        $validated = $request->validated();

        $role = Role::create($validated);
        $permissions = Permission::whereIn('id', $validated['permissions'])->get();
        if ($permissions->count() !== count($validated['permissions'])) {
            return back()->withErrors(['permissions' => 'Invalid permissions selected.']);
        }

        $role->syncPermissions($permissions);
        Splade::toast('Role created!')->autoDismiss(3);

        return to_route('admin.roles.index');
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {

        return view('admin.roles.edit', [
            'role' => $role,
            'permissions' => Permission::pluck('name', 'id')->toArray()
        ]);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {
        $validated = $request->validated();

        // Update role information (if applicable)
        $role->update($validated);

        // Sync permissions based on selected options
        $permissions = Permission::whereIn('id', $validated['permissions'])->get();

        $role->syncPermissions($permissions);

        Splade::toast('Role updated!')->autoDismiss(3);

        return to_route('admin.roles.index');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->delete();
        Splade::toast('Role deleted')->autoDismiss(3);

        return back();
    }
}
