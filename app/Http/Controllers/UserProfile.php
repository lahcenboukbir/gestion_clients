<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserProfile extends Controller
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
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $authenticated_user  = auth()->user();

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
            ->where('users.id', $authenticated_user->id)
            ->first();

        return view('user-profile.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $authenticated_user  = auth()->user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', 'unique:users,email,' . $authenticated_user->id],
            'password' => 'nullable|string|min:6|confirmed',
            'phone_number' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'bio' => 'nullable|string|max:255',
        ]);

        // Only hash the password if it's provided
        if ($request->filled('password')) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']); // Remove the password from validation if not set
        }

        DB::table('users')->where('id', $authenticated_user->id)->update($validated);

        return redirect()->route('profile.show');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
