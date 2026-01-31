<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class RoleController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:roles_view',   only: ['index']),
            new Middleware('permission:roles_create', only: ['create','store']),
            new Middleware('permission:roles_edit',   only: ['edit','update']),
            new Middleware('permission:roles_delete', only: ['destroy']),
        ];
    }

    public function index()
    {
        $roles = Role::query()
            ->withCount(['permissions','users'])
            ->latest('created_at')
            ->paginate(25);

        return view('admin.roles.index', compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::orderBy('name')->get();
        return view('admin.roles.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'         => ['required','string','min:3','unique:roles,name'],
            'permissions'  => ['nullable','array'],
            'permissions.*'=> ['string','exists:permissions,name'],
        ]);

        $role = Role::create([
            'name'       => $data['name'],
            'guard_name' => config('auth.defaults.guard', 'web'),
        ]);

        $role->syncPermissions($data['permissions'] ?? []);

        return redirect()->route('admin.roles.index')->with('success','Role created.');
    }

    public function edit(Role $role)
    {
        $permissions     = Permission::orderBy('name')->get();
        $rolePermissions = $role->permissions->pluck('name')->toArray();

        return view('admin.roles.edit', compact('role','permissions','rolePermissions'));
    }

    public function update(Request $request, Role $role)
    {
        $data = $request->validate([
            'name'         => ['required','string','min:3', Rule::unique('roles','name')->ignore($role->id)],
            'permissions'  => ['nullable','array'],
            'permissions.*'=> ['string','exists:permissions,name'],
        ]);

        $role->update(['name' => $data['name']]);
        $role->syncPermissions($data['permissions'] ?? []);

        return redirect()->route('admin.roles.index')->with('success','Role updated.');
    }

    public function destroy(Role $role)
    {
        if ($role->name === 'admin') {
            return back()->with('error','Role "admin" dilindungi dan tidak boleh dihapus.');
        }

        $role->delete();
        return redirect()->route('admin.roles.index')->with('success','Role deleted.');
    }
}
