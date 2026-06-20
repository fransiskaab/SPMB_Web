<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of administrative users.
     */
    public function index()
    {
        // Exclude calon_murid student accounts
        $users = User::where('role', '!=', 'calon_murid')
            ->orderBy('role', 'asc')
            ->orderBy('name', 'asc')
            ->get();
            
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new administrative user.
     */
    public function create()
    {
        $roles = [
            'admin' => 'Administrator',
            'staff' => 'Staff',
            'operator' => 'Operator',
            'kepala_sekolah' => 'Kepala Sekolah',
        ];
        
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created administrative user in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|in:admin,staff,operator,kepala_sekolah',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', 'Pengguna baru berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified administrative user.
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        
        $roles = [
            'admin' => 'Administrator',
            'staff' => 'Staff',
            'operator' => 'Operator',
            'kepala_sekolah' => 'Kepala Sekolah',
        ];

        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified administrative user in storage.
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8',
            'role' => 'required|in:admin,staff,operator,kepala_sekolah',
        ]);

        $isActive = $request->has('is_active') ? true : false;

        // Prevent self-deactivation
        if ($user->id === Auth::id() && !$isActive) {
            return redirect()->route('admin.users.index')
                ->with('error', 'Anda tidak diperbolehkan menonaktifkan akun Anda sendiri.');
        }

        $updateData = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $user->id === Auth::id() ? $user->role : $request->role,
            'is_active' => $user->id === Auth::id() ? true : $isActive,
        ];

        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($request->password);
        }

        $user->update($updateData);

        return redirect()->route('admin.users.index')
            ->with('success', 'Data pengguna berhasil diperbarui.');
    }

    /**
     * Remove the specified administrative user from storage.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if ($user->id === Auth::id()) {
            return redirect()->route('admin.users.index')
                ->with('error', 'Anda tidak diperbolehkan menghapus akun Anda sendiri.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'Pengguna berhasil dihapus.');
    }
}
