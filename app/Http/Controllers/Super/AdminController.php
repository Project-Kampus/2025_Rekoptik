<?php


namespace App\Http\Controllers\Super;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        // Daftar role yang ingin dikelola oleh superadmin
        $rolesToManage = ['admin', 'bpjs', 'dimkes'];

        // Jika user memilih filter role via query param
        $filterRole = $request->role;
        if ($filterRole && in_array($filterRole, $rolesToManage)) {
            $rolesToManage = [$filterRole];
        }

        // Ambil semua user dengan role yang sesuai
        $admins = User::whereHas('roles', function ($q) use ($rolesToManage) {
            $q->whereIn('name', $rolesToManage);
        })->paginate(20)->withQueryString();

        return view('admin.admin_index', compact('admins'));
    }

    /**
     * Form tambah admin
     */
    public function create()
    {
        return view('admin.admin_create');
    }

    /**
     * Simpan admin baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'role' => ['required', Rule::in(['admin', 'bpjs', 'dimkes'])],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        // Assign role (hanya satu)
        $role = Role::where('name', $validated['role'])->first();
        if ($role) {
            $user->roles()->sync([$role->id]);
        }

        return redirect()->route('admin.index')->with('success', 'Admin berhasil ditambahkan.');
    }

    /**
     * Form edit admin
     */
    public function edit(User $admin)
    {
        return view('admin.admin_edit', compact('admin'));
    }

    /**
     * Update admin
     */
    public function update(Request $request, User $admin)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($admin->id)],
            'password' => 'nullable|string|min:6|confirmed',
            'role' => ['required', Rule::in(['admin', 'bpjs', 'dimkes'])],
        ]);

        $admin->name = $validated['name'];
        $admin->email = $validated['email'];

        // Update password jika diisi
        if (!empty($validated['password'])) {
            $admin->password = Hash::make($validated['password']);
        }

        $admin->save();

        // Update role (hanya satu)
        $role = Role::where('name', $validated['role'])->first();
        if ($role) {
            $admin->roles()->sync([$role->id]);
        }
        return redirect()->route('admin.index')->with('success', 'Admin berhasil diperbarui.');
    }

    /**
     * Hapus admin
     */
    public function destroy(User $admin)
    {
        // Lepas role admin sebelum hapus (opsional)
        $adminRole = Role::where('name', 'admin')->first();
        if ($adminRole) {
            $admin->roles()->detach($adminRole->id);
        }

        $admin->delete();

        return redirect()->route('admin.index')->with('success', 'Admin berhasil dihapus.');
    }
}
