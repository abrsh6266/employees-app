<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePermissionRequest;
use App\Http\Requests\CreateRoleRequest;
use App\Http\Requests\UpdatePermissionRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Tables\Permissions;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\Facades\Splade;
use ProtoneMedia\Splade\SpladeForm;
use ProtoneMedia\Splade\FormBuilder\Input;
use ProtoneMedia\Splade\FormBuilder\Submit;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    public function index()
    {
        return view("admin.permissions.index", [
            "permissions" => Permissions::class,
        ]);
    }
    public function create()
    {
        return view('admin.permissions.create', [
            'roles' => Role::pluck('name', 'id')->toArray(),
        ]);
    }
    public function store(CreatePermissionRequest $request)
    {
        $validated = $request->validated();

        $permission = Permission::create($request->validated());

        // Sync roles based on selected options
        $roles = Role::whereIn('id', $validated['roles'])->get();

        $permission->syncRoles($roles);

        Splade::toast('Permission created!')->autoDismiss(3);

        return to_route('admin.permissions.index');
    }

    public function edit(Permission $permission)
    {
        return view('admin.permissions.edit', [
            'permission' => $permission,
            'roles' => Role::pluck('name', 'id')->toArray(),
        ]);
    }
    public function update(UpdatePermissionRequest $request, Permission $permission)
    {
        $validated = $request->validated();

        $permission->update($validated);

        // Sync roles based on selected options
        $roles = Role::whereIn('id', $validated['roles'])->get();
        
        $permission->syncRoles($roles);

        Splade::toast('Permission updated!')->autoDismiss(3);

        return to_route('admin.permissions.index');
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();
        Splade::toast('Permission deleted!')->autoDismiss(3);
        return back();
    }
}
