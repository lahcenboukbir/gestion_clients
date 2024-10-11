<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = DB::table('model_has_roles')
            ->join('users', 'users.id', 'model_has_roles.model_id')
            ->join('roles', 'roles.id', 'model_has_roles.role_id')
            ->select(
                'users.id as user_id',
                'users.name as user_name',
                'roles.name as role_name'
            )
            ->get();

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = DB::table('roles')
            ->select('id', 'name')
            ->get();

        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role_id' => 'exists:roles,id',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'],
        ]);

        // Find the role by ID
        $role = Role::find($validated['role_id']);

        // Assign the role to the user
        $user->assignRole($role);

        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = DB::table('model_has_roles')
            ->join('users', 'users.id', 'model_has_roles.model_id')
            ->join('roles', 'roles.id', 'model_has_roles.role_id')
            ->select(
                'users.name as user_name',
                'users.email',
                'users.address',
                'users.phone_number',
                'users.bio',
                'roles.name as role_name'
            )
            ->where('users.id', $id)
            ->first();

        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = DB::table('users')->where('id', $id)->first();

        $user_role = DB::table('model_has_roles')
            ->join('users', 'users.id', 'model_has_roles.model_id')
            ->join('roles', 'roles.id', 'model_has_roles.role_id')
            ->select(
                'users.id as user_id',
                'users.name as user_name',
                'roles.id as role_id',
                'roles.name as role_name'
            )
            ->where('users.id', $id)
            ->first();

        $roles = DB::table('roles')
            ->select('id', 'name')
            ->get();

        return view('users.edit', compact('user', 'user_role', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', 'unique:users,email,' . $id],
            'password' => 'nullable|string|min:6|confirmed',
            'phone_number' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'bio' => 'nullable|string|max:255',
            'role_id' => 'exists:roles,id',
        ]);

        // Only hash the password if it's provided
        if ($request->filled('password')) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']); // Remove the password from validation if not set
        }

        $user = User::findOrFail($id);
        $user->update($validated);

        // Update the user's role if role_id is provided
        if ($request->filled('role_id')) {
            $role = Role::find($validated['role_id']);
            $user->syncRoles($role);
        }

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = DB::table('users')->where('id', $id)->first();

        if ($user) {
            DB::table('users')->where('id', $id)->delete();
        }

        return redirect()->route('users.index');
    }
}
