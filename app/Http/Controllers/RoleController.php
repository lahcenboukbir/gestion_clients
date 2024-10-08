<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
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
        $roles = DB::table('roles')->get();

        return view('roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = DB::table('permissions')->get();

        return view('roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'permissions' => 'required|array',
            'permissions.*' => 'exists:permissions,id'
        ]);

        $role_id = DB::table('roles')->insertGetId([
            'name' => $validated['name'],
            'guard_name' => 'web'
        ]);

        foreach ($validated['permissions'] as $permission_id) {
            DB::table('role_has_permissions')->insert([
                'permission_id' => $permission_id,
                'role_id' => $role_id
            ]);
        }

        return redirect()->route('roles.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $role = DB::table('roles')
            ->select('name')
            ->where('id', $id)
            ->first();

        $role_permissions = DB::table('role_has_permissions')
            ->join('roles', 'roles.id', 'role_has_permissions.role_id')
            ->join('permissions', 'permissions.id', 'role_has_permissions.permission_id')
            ->select('permissions.name')
            ->where('roles.id', $id)
            ->get();

        return view('roles.show', compact('role', 'role_permissions'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $role = DB::table('roles')
            ->select('id', 'name')
            ->where('id', $id)
            ->first();

        $permissions = DB::table('permissions')->get();

        $assigned_permissions  = DB::table('role_has_permissions')
            ->where('role_id', $id)
            ->pluck('permission_id')
            ->toArray();

        return view('roles.edit', compact('role', 'permissions', 'assigned_permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'permissions' => 'required|array',
            'permissions.*' => 'exists:permissions,id'
        ]);

        DB::table('roles')
            ->where('id', $id)
            ->update([
                'name' => $validated['name']
            ]);

        // Remove old permissions and assign new ones
        DB::table('role_has_permissions')
            ->where('role_id', $id)
            ->delete();

        foreach ($validated['permissions'] as $permission_id) {
            DB::table('role_has_permissions')->insert([
                'permission_id' => $permission_id,
                'role_id' => $id
            ]);
        }

        return redirect()->route('roles.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $role = DB::table('roles')->where('id', $id)->first();

        if ($role) {
            DB::table('roles')->where('id', $id)->delete();
        }

        return redirect()->route('roles.index');
    }
}
