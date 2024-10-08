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

        // dd($recently_companies);

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
            'recently_companies'
        ));
    }
}
