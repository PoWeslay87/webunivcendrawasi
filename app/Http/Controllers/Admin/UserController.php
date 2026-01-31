<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

// Laravel 11 controller-middleware:
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;

class UserController extends Controller implements HasMiddleware
{
    /**
     * Laravel 11: daftarkan middleware per-aksi di sini,
     * bukan di __construct() lagi.
     */
    public static function middleware(): array
    {
        return [
            new Middleware('permission:users_view', only: ['index']),
            new Middleware('permission:users_create', only: ['create', 'store']),
            new Middleware('permission:users_edit', only: ['edit', 'update']),
            new Middleware('permission:users_delete', only: ['destroy']),
        ];
    }

    // LIST + search
    public function index(Request $request)
    {
        $q = $request->query('q');
        $users = User::when($q, fn($s)=>$s->where(fn($w)=>$w
                        ->where('name','like',"%$q%")
                        ->orWhere('email','like',"%$q%")))
                    ->orderBy('id')
                    ->paginate(15)
                    ->withQueryString();

        return view('admin.users.index', compact('users','q'));
    }

    // FORM CREATE
    public function create()
    {
        $roles = Role::orderBy('name')->get();
        return view('admin.users.create', compact('roles'));
    }

    // SIMPAN USER BARU
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'     => 'required|string|min:3',
            'email'    => 'required|email|unique:users,email',
            'password' => 'nullable|string|min:8|confirmed',
            'roles'    => 'nullable|array',
            'roles.*'  => 'exists:roles,name',
        ]);

        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password'] ?? 'password123'),
        ]);

        $user->syncRoles($data['roles'] ?? []);

        return redirect()->route('admin.users.index')->with('success', 'User created!');
    }

    // EDIT
    public function edit(User $user)
    {
        $roles    = Role::orderBy('name')->get();
        $userRole = $user->roles->pluck('name')->toArray();

        return view('admin.users.edit', compact('user','roles','userRole'));
    }

    // UPDATE
    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name'      => 'required|string|min:3',
            'email'     => 'required|email|unique:users,email,'.$user->id,
            'password'  => 'nullable|string|min:8|confirmed',
            'roles'     => 'nullable|array',
            'roles.*'   => 'exists:roles,name',
        ]);

        $payload = [
            'name'  => $data['name'],
            'email' => $data['email'],
        ];

        if (!empty($data['password'])) {
            $payload['password'] = Hash::make($data['password']);
        }

        $user->update($payload);
        $user->syncRoles($data['roles'] ?? []);

        return redirect()->route('admin.users.index')->with('success', 'User updated!');
    }

    // DELETE
    public function destroy(User $user)
    {
        if (auth()->id() === $user->id) {
            return back()->with('error', 'Tidak bisa menghapus akun yang sedang dipakai.');
        }
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User deleted!');
    }
}
