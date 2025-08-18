<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use App\Models\Institution;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Models\Access;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('roles')->get();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $polres = Institution::where('level', 1)->get();
        $roles = Role::all();
        $is_edit = false;
        $user = null;
        $polres_id = null;
        $polsek_id = null;
        return view('admin.users.create', compact('roles', 'polres', 'is_edit', 'user', 'polres_id', 'polsek_id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'string', 'exists:roles,name'],
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'name.max' => 'Nama lengkap maksimal 255 karakter.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak sama.',
            'role.required' => 'Role wajib dipilih.',
            'role.exists' => 'Role yang dipilih tidak valid.',
        ]);

        try {
            DB::beginTransaction();
            // Create user
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
            ]);

            // Assign role
            $user->assignRole($validated['role']);

            // assign access institution
            if ($request->role == 'polsek') {
                Access::create([
                    'user_id' => $user->id,
                    'institution_id' => $request->polsek_id,
                ]);
            } else if ($request->role == 'polres') {
                Access::create([
                    'user_id' => $user->id,
                    'institution_id' => $request->polres_id,
                ]);
            } else if ($request->role == 'polda') {
                // find data polda
                $polda = Institution::where('level', 0)->first();
                Access::create([
                    'user_id' => $user->id,
                    'institution_id' => $polda->id,
                ]);
            }

            DB::commit();
            return redirect()->route('dashboard.users.index')
                ->with('success', 'User berhasil ditambahkan dengan role ' . ucfirst($validated['role']) . '.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat menyimpan data user: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::with('roles')->findOrFail($id);
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $polres = Institution::where('level', 1)->get();
        $roles = Role::all();
        $is_edit = true;
        $user = User::findOrFail($id);
        // get access
        $access = Access::where('user_id', $id)->first();
        $polres_id = null;
        $polsek_id = null;
        if ($access) {
            if ($access->institution->level == 1) {
                $polres_id = $access->institution->id;
            } else {
                $polres_id = $access->institution->parent_id;
                $polsek_id = $access->institution->id;
            }
        }

        return view('admin.users.create', compact('roles', 'polres', 'is_edit', 'user', 'access', 'polres_id', 'polsek_id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $rules = [
            'name'  => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $id],
            'role'  => ['required', 'string', 'exists:roles,name'],
        ];

        // Tambah rule password jika diisi
        if ($request->filled('password')) {
            $rules['password'] = ['required', 'string', 'min:8', 'confirmed'];
        } else {
            $rules['password'] = ['nullable'];
        }

        $messages = [
            'name.required'  => 'Nama lengkap wajib diisi.',
            'name.max'       => 'Nama lengkap maksimal 255 karakter.',
            'email.required' => 'Email wajib diisi.',
            'email.email'    => 'Format email tidak valid.',
            'email.unique'   => 'Email sudah terdaftar.',
            'role.required'  => 'Role wajib dipilih.',
            'role.exists'    => 'Role yang dipilih tidak valid.',
            'password.required' => 'Password wajib diisi.',
            'password.min'      => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak sesuai.',
        ];

        $validated = $request->validate($rules, $messages);

        try {
            DB::beginTransaction();
            // Create user
            $user = User::findOrFail($id);
            $user->name = $validated['name'];
            $user->email = $validated['email'];
            if ($request->password) {
                $user->password = Hash::make($request->password);
            }
            $user->save();

            // delete old role
            $user->roles()->detach();

            // delete old access
            Access::where('user_id', $id)->delete();

            // Assign role
            $user->assignRole($validated['role']);

            // assign access institution
            if ($request->role == 'polsek') {
                Access::create([
                    'user_id' => $user->id,
                    'institution_id' => $request->polsek_id,
                ]);
            } else if ($request->role == 'polres') {
                Access::create([
                    'user_id' => $user->id,
                    'institution_id' => $request->polres_id,
                ]);
            } else if ($request->role == 'polda') {
                // find data polda
                $polda = Institution::where('level', 0)->first();
                Access::create([
                    'user_id' => $user->id,
                    'institution_id' => $polda->id,
                ]);
            }

            DB::commit();
            return redirect()->route('dashboard.users.index')
                ->with('success', 'User berhasil ditambahkan dengan role ' . ucfirst($validated['role']) . '.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat menyimpan data user: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            DB::beginTransaction();
            $user = User::findOrFail($id);
            $user->delete();

            // delete data akses
            Access::where('user_id', $id)->delete();
            // delete data role
            $user->roles()->detach();
            DB::commit();
            return redirect()->route('dashboard.users.index')
                ->with('success', 'User berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat menghapus data user: ' . $e->getMessage());
        }
    }

    public function getPolsek(Request $request, $polres_id)
    {
        $polsek = Institution::where('level', 2)->where('parent_id', $polres_id)->get();
        return response()->json($polsek);
    }
}