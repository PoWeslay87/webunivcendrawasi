<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission;

// Laravel 11 style controller middleware
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;

class PermissionController extends Controller implements HasMiddleware
{
    /**
     * Proteksi tiap aksi dengan permission Spatie.
     */
    public static function middleware(): array
    {
        return [
            new Middleware('permission:permissions_view',   only: ['index']),
            new Middleware('permission:permissions_create', only: ['create','store']),
            new Middleware('permission:permissions_edit',   only: ['edit','update']),
            new Middleware('permission:permissions_delete', only: ['destroy']),
        ];
    }

    /**
     * GET /admin/permissions -> admin.permissions.index
     * List + (opsional) pencarian.
     */
    public function index(Request $request)
    {
        $guard = config('auth.defaults.guard', 'web');
        $q     = $request->query('q');

        $permissions = Permission::query()
            ->where('guard_name', $guard)
            ->when($q, fn ($s) => $s->where('name', 'like', "%{$q}%"))
            ->withCount(['roles','users'])
            ->latest('created_at')
            ->paginate(10)
            ->withQueryString();

        return view('admin.permissions.index', compact('permissions', 'q'));
    }

    // GET /admin/permissions/create -> admin.permissions.create
    public function create()
    {
        return view('admin.permissions.create');
    }

    // POST /admin/permissions -> admin.permissions.store
    public function store(Request $request)
    {
        $guard = config('auth.defaults.guard', 'web');

        $validated = $request->validate([
            'name' => [
                'required','string','min:3',
                Rule::unique('permissions', 'name')->where('guard_name', $guard),
            ],
        ]);

        Permission::create([
            'name'       => $validated['name'],
            'guard_name' => $guard,
        ]);

        return redirect()
            ->route('admin.permissions.index')
            ->with('success', 'Permission added successfully.');
    }

    // GET /admin/permissions/{permission}/edit -> admin.permissions.edit
    public function edit(Permission $permission)
    {
        return view('admin.permissions.edit', compact('permission'));
    }

    // PUT /admin/permissions/{permission} -> admin.permissions.update
    public function update(Request $request, Permission $permission)
    {
        $guard = config('auth.defaults.guard', 'web');

        $validated = $request->validate([
            'name' => [
                'required','string','min:3',
                Rule::unique('permissions', 'name')
                    ->where('guard_name', $guard)
                    ->ignore($permission->id),
            ],
        ]);

        $permission->update(['name' => $validated['name']]);

        return redirect()
            ->route('admin.permissions.index')
            ->with('success', 'Permission updated successfully.');
    }

    // DELETE /admin/permissions/{permission} -> admin.permissions.destroy
    public function destroy(Request $request, Permission $permission)
    {
        // Lindungi set inti (opsional)
        $protected = [
            'roles_view','roles_create','roles_edit','roles_delete',
            'permissions_view','permissions_create','permissions_edit','permissions_delete',
            'users_view','users_create','users_edit','users_delete',
        ];
        if (in_array($permission->name, $protected, true)) {
            return back()->with('error', 'This permission is protected and cannot be deleted.');
        }

        $permission->delete();

        return $request->ajax() || $request->wantsJson()
            ? response()->json(['ok' => true])
            : redirect()->route('admin.permissions.index')->with('success', 'Permission deleted.');
    }
}
