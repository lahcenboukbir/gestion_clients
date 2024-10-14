<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

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
        $users_permissions = DB::table('permissions')
            ->where('name', 'LIKE', '%users')
            ->get();

        $prospects_permissions = DB::table('permissions')
            ->where('name', 'LIKE', '%prospects')
            ->get();

        $customers_permissions = DB::table('permissions')
            ->where('name', 'LIKE', '%customers')
            ->get();

        $appointments_permissions = DB::table('permissions')
            ->where('name', 'LIKE', '%appointments')
            ->get();

        $generate_reports = DB::table('permissions')
            ->where('name', 'generate reports')
            ->get();

        return view('roles.create', compact(
            'users_permissions',
            'customers_permissions',
            'prospects_permissions',
            'appointments_permissions',
            'generate_reports'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'permissions' => 'required|array',
            'permissions.*' => 'exists:permissions,name'
        ]);

        $role = Role::create(['name' => $validated['name'], 'guard_name' => 'web']);

        $role->givePermissionTo($validated['permissions']);

        return redirect()->route('roles.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // role
        $role = DB::table('roles')
            ->select('name')
            ->where('id', $id)
            ->first();

        // users
        $all_users_permissions = DB::table('permissions')
            ->where('permissions.name', 'LIKE', '%users')
            ->pluck('name')
            ->toArray();

        $users_permissions = DB::table('role_has_permissions')
            ->join('roles', 'roles.id', 'role_has_permissions.role_id')
            ->join('permissions', 'permissions.id', 'role_has_permissions.permission_id')
            ->select('permissions.name')
            ->where('roles.id', $id)
            ->where('permissions.name', 'LIKE', '%users')
            ->pluck('permissions.name')
            ->toArray();

        // prospects
        $all_prospects_permissions = DB::table('permissions')
            ->where('permissions.name', 'LIKE', '%prospects')
            ->pluck('name')
            ->toArray();

        $prospects_permissions = DB::table('role_has_permissions')
            ->join('roles', 'roles.id', 'role_has_permissions.role_id')
            ->join('permissions', 'permissions.id', 'role_has_permissions.permission_id')
            ->select('permissions.name')
            ->where('roles.id', $id)
            ->where('permissions.name', 'LIKE', '%prospects')
            ->pluck('permissions.name')
            ->toArray();

        // customers
        $all_customers_permissions = DB::table('permissions')
            ->where('permissions.name', 'LIKE', '%customers')
            ->pluck('name')
            ->toArray();

        $customers_permissions = DB::table('role_has_permissions')
            ->join('roles', 'roles.id', 'role_has_permissions.role_id')
            ->join('permissions', 'permissions.id', 'role_has_permissions.permission_id')
            ->select('permissions.name')
            ->where('roles.id', $id)
            ->where('permissions.name', 'LIKE', '%customers')
            ->pluck('permissions.name')
            ->toArray();

        // appointments
        $all_appointments_permissions = DB::table('permissions')
            ->where('permissions.name', 'LIKE', '%appointments')
            ->pluck('name')
            ->toArray();

        $appointments_permissions = DB::table('role_has_permissions')
            ->join('roles', 'roles.id', 'role_has_permissions.role_id')
            ->join('permissions', 'permissions.id', 'role_has_permissions.permission_id')
            ->select('permissions.name')
            ->where('roles.id', $id)
            ->where('permissions.name', 'LIKE', '%appointments')
            ->pluck('permissions.name')
            ->toArray();

        // reports
        $all_reports_permissions = DB::table('permissions')
            ->where('permissions.name', 'generate reports')
            ->pluck('name')
            ->toArray();

        $reports_permissions = DB::table('role_has_permissions')
            ->join('roles', 'roles.id', 'role_has_permissions.role_id')
            ->join('permissions', 'permissions.id', 'role_has_permissions.permission_id')
            ->select('permissions.name')
            ->where('roles.id', $id)
            ->where('permissions.name', 'generate reports')
            ->pluck('permissions.name')
            ->toArray();

        return view('roles.show', compact(
            'role',

            'all_users_permissions',
            'users_permissions',

            'all_prospects_permissions',
            'prospects_permissions',

            'all_customers_permissions',
            'customers_permissions',

            'all_appointments_permissions',
            'appointments_permissions',

            'all_reports_permissions',
            'reports_permissions',
        ));
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

        $assigned_permissions  = DB::table('role_has_permissions')
            ->join('permissions', 'role_has_permissions.permission_id', '=', 'permissions.id')
            ->where('role_id', $id)
            ->pluck('permissions.name')
            ->toArray();

        $users_permissions = DB::table('permissions')->where('name', 'LIKE', '%users')->get();
        $prospects_permissions = DB::table('permissions')->where('name', 'LIKE', '%prospects')->get();
        $customers_permissions = DB::table('permissions')->where('name', 'LIKE', '%customers')->get();
        $appointments_permissions = DB::table('permissions')->where('name', 'LIKE', '%appointments')->get();
        $reports_permissions = DB::table('permissions')->where('name', 'generate reports')->get();

        return view('roles.edit', compact(
            'role',
            'assigned_permissions',
            'users_permissions',
            'prospects_permissions',
            'customers_permissions',
            'appointments_permissions',
            'reports_permissions'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'permissions' => 'required|array',
            'permissions.*' => 'exists:permissions,name'
        ]);

        $role = Role::findOrFail($id);

        $role->update(['name' => $validated['name']]);

        $role->syncPermissions($validated['permissions']);

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

    public function test($id)
    {
        $role = DB::table('roles')
            ->select('id', 'name')
            ->where('id', $id)
            ->first();

        $assigned_permissions  = DB::table('role_has_permissions')
            ->join('permissions', 'role_has_permissions.permission_id', '=', 'permissions.id')
            ->where('role_id', $id)
            ->pluck('permissions.name')
            ->toArray();

        $users_permissions = DB::table('permissions')->where('name', 'LIKE', '%users')->get();
        $prospects_permissions = DB::table('permissions')->where('name', 'LIKE', '%prospects')->get();
        $customers_permissions = DB::table('permissions')->where('name', 'LIKE', '%customers')->get();
        $appointments_permissions = DB::table('permissions')->where('name', 'LIKE', '%appointments')->get();

        return view('roles.test', compact(
            'role',
            'assigned_permissions',
            'users_permissions',
            'prospects_permissions',
            'customers_permissions',
            'appointments_permissions'
        ));
    }
}
