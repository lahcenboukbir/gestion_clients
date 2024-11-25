<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PDFController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function allUsers()
    {
        $users = DB::table('users')
        ->select('id', 'name', 'email', 'created_at')
        ->get();

        $pdf = Pdf::loadView('pdf.all_users', compact('users'));

        $timestamp = now()->format('d.m.Y');

        return $pdf->stream('rapport_utilisateurs_'.$timestamp.'.pdf');
    }

    public function allProspects()
    {
        $prospects = DB::table('prospects')->where('status', '!=', 'customer')->get();

        $appointments = DB::table('appointments')
            ->join('prospects', 'prospects.id', '=', 'appointments.prospect_id')
            ->select(
                'prospects.name',
                'prospects.status',
                'appointments.appointment_date',
                'appointments.notes',
                'appointments.outcome'
            )
            ->where('prospects.status', '!=', 'customer')
            ->get();

        $users = DB::table('users')
            ->join('prospects', 'prospects.user_id', '=', 'users.id')
            ->select(
                'prospects.name',
                'prospects.company',
                'users.name as salesperson',
            )
            ->where('prospects.status', '!=', 'customer')
            ->get();

        $pdf = Pdf::loadView('pdf.all_prospects', compact('prospects', 'appointments', 'users'));

        $timestamp = now()->format('d.m.Y');

        return $pdf->stream('rapport_prospects_'.$timestamp.'.pdf');
    }

    public function allCustomers()
    {

        $customers = DB::table('customers')
            ->join('prospects', 'prospects.id', '=', 'customers.prospect_id')
            ->where('prospects.status', '=', 'customer')
            ->get();

        $appointments = DB::table('appointments')
            ->join('prospects', 'prospects.id', '=', 'appointments.prospect_id')
            ->select(
                'prospects.name',
                'prospects.status',
                'appointments.appointment_date',
                'appointments.notes',
                'appointments.outcome'
            )
            ->where('prospects.status', '=', 'customer')
            ->get();

        $users = DB::table('users')
            ->join('prospects', 'prospects.user_id', '=', 'users.id')
            ->select(
                'prospects.name',
                'prospects.company',
                'users.name as salesperson',
            )
            ->where('prospects.status', '=', 'customer')
            ->get();

        $pdf = Pdf::loadView('pdf.all_customers', compact('customers', 'appointments', 'users'));

        $timestamp = now()->format('d.m.Y');

        return $pdf->stream('rapport_clients_'.$timestamp.'.pdf');
    }

    public function allAppointments()
    {
        $appointments = DB::table('appointments')
        ->join('prospects', 'prospects.id', '=', 'appointments.prospect_id')
        ->orderBy('appointments.appointment_date', 'desc')
        ->get()
        ;

        $pdf = Pdf::loadView('pdf.all_appointments', compact('appointments'));

        $timestamp = now()->format('d.m.Y');

        return $pdf->stream('rapport_rendez-vous_'.$timestamp.'.pdf');
    }
}
