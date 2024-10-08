<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class AssignRoleController extends Controller
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
        $users_role = DB::table('model_has_roles')
            ->join('users', 'users.id', 'model_has_roles.model_id')
            ->join('roles', 'roles.id', 'model_has_roles.role_id')
            ->select(
                'users.id as user_id',
                'users.name as user_name',
                'roles.name as role_name'
            )
            ->get();

        return view('assign-roles.index', compact('users_role'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = DB::table('users')
            ->select('id', 'name')
            ->get();

        $roles = DB::table('roles')
            ->select('id', 'name')
            ->get();

        return view('assign-roles.create', compact('users', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'exists:users,id',
            'role_id' => 'exists:roles,id',
        ]);

        $user = User::find($validated['user_id']);
        $role = Role::find($validated['role_id']);

        $user->assignRole($role);

        return redirect()->route('assign.roles.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
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

        return view('assign-roles.edit', compact('user_role', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'user_id' => 'exists:users,id',
            'role_id' => 'exists:roles,id',
        ]);

        $user = User::find($validated['user_id']);
        $role = Role::find($validated['role_id']);

        $user->syncRoles($role);

        return redirect()->route('assign.roles.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user_role = DB::table('model_has_roles')
            ->where('model_id', $id)
            ->first();

        if ($user_role) {
            $user_role = DB::table('model_has_roles')
                ->where('model_id', $id)
                ->delete();
        }

        return redirect()->route('assign.roles.index');
    }
}
