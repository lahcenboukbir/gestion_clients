<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = auth()->user();

        if ($user->hasRole('admin')) {
            // Cards
            $users_count = DB::table('users')->count();

            $prospects_count = DB::table('prospects')
                ->where('status', '!=', 'customer')
                ->count();

            $customers_count = DB::table('prospects')
                ->where('status', 'customer')
                ->count();

            $appointments_count = DB::table('appointments')
                ->count();

            // Radialbar Chart
            $status_new = DB::table('prospects')
                ->where('status', 'new')
                ->count();

            $status_interested = DB::table('prospects')
                ->where('status', 'interested')
                ->count();

            $status_not_interested = DB::table('prospects')
                ->where('status', 'not_interested')
                ->count();

            $status_customer = DB::table('prospects')
                ->where('status', 'customer')
                ->count();

            // Events - Calendar
            $events = DB::table('appointments')
                ->join('prospects', 'prospects.id', 'appointments.prospect_id')
                ->select(
                    'prospects.name',
                    (DB::raw("DATE_FORMAT(appointments.appointment_date, '%Y-%m-%d') as formatted_date"))
                )
                ->get();
        } else {
            // Cards
            $users_count = DB::table('users')->count();

            $prospects_count = DB::table('prospects')
                ->where('status', '!=', 'customer')
                ->where('user_id', $user->id)
                ->count();

            $customers_count = DB::table('prospects')
                ->where('status', 'customer')
                ->where('user_id', $user->id)
                ->count();

            $appointments_count = DB::table('appointments')
                ->where('user_id', $user->id)
                ->count();

            // Radialbar Chart
            $status_new = DB::table('prospects')
                ->where('status', 'new')
                ->where('user_id', $user->id)
                ->count();

            $status_interested = DB::table('prospects')
                ->where('status', 'interested')
                ->where('user_id', $user->id)
                ->count();

            $status_not_interested = DB::table('prospects')
                ->where('status', 'not_interested')
                ->where('user_id', $user->id)
                ->count();

            $status_customer = DB::table('prospects')
                ->where('status', 'customer')
                ->where('user_id', $user->id)
                ->count();

            // Events - Calendar
            $events = DB::table('appointments')
                ->join('prospects', 'prospects.id', 'appointments.prospect_id')
                ->select(
                    'prospects.name',
                    (DB::raw("DATE_FORMAT(appointments.appointment_date, '%Y-%m-%d') as formatted_date"))
                )
                ->where('appointments.user_id', $user->id)
                ->get();
        }

        // Recently added users
        $recently_users = DB::table('users')
            ->select('id', 'name', 'email', 'phone_number')
            ->orderBy('id', 'desc')
            ->limit(5)
            ->get();

        // Recently added companies
        $recently_companies = DB::table('prospects')
            ->select('id', 'company', 'city', 'phone_number')
            ->orderBy('id', 'desc')
            ->limit(5)
            ->get();

        // Top performing users
        $top_users = DB::table('users')
            ->join('model_has_roles', 'model_has_roles.model_id', 'users.id')
            ->join('roles', 'roles.id', 'model_has_roles.role_id')
            ->join('prospects', 'prospects.user_id', 'users.id')
            ->select(
                'users.name as user_name',
                'prospects.status',
                'roles.name as role_name',
                DB::raw('COUNT(prospects.user_id) as total_customers')
            )
            ->groupBy('users.name', 'prospects.status', 'roles.name', 'prospects.user_id')
            ->having('total_customers', '>=', 10)
            ->having('prospects.status', 'customer')
            ->limit(4)
            ->get();

        // Low performing users
        $low_users = DB::table('users')
            ->join('model_has_roles', 'model_has_roles.model_id', 'users.id')
            ->join('roles', 'roles.id', 'model_has_roles.role_id')
            ->join('prospects', 'prospects.user_id', 'users.id')
            ->select(
                'users.name as user_name',
                'prospects.status',
                'roles.name as role_name',
                DB::raw('COUNT(prospects.user_id) as total_customers')
            )
            ->groupBy('users.name', 'prospects.status', 'roles.name', 'prospects.user_id')
            ->having('total_customers', '<', 10)
            ->having('prospects.status', 'customer')
            ->limit(5)
            ->get();

        //
        $prospect_counts = DB::table('prospects')
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as total_prospects'))
            ->groupBy(DB::raw('DATE(created_at)'))
            ->where('status', '!=', 'customer')
            ->get();

        // dd($prospect_counts);

        return view('dashboard.index', compact(
            'users_count',
            'prospects_count',
            'customers_count',
            'appointments_count',
            'status_new',
            'status_interested',
            'status_not_interested',
            'status_customer',
            'recently_users',
            'recently_companies',
            'events',
            'top_users',
            'low_users',
            'prospect_counts'
        ));
    }
}
