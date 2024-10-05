<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Rap2hpoutre\FastExcel\Facades\FastExcel;

class ExcelController extends Controller
{
    public function allUsers() {
        $users = DB::table('users')
        ->select(
            'name',
            'email',
            'phone_number',
            'address',
            'bio',
            'role',
            )
        ->get();

        return FastExcel::data($users)->download('users_report.xlsx');
    }

    public function allProspects()
    {
        $prospects = DB::table('prospects')
            ->join('users', 'users.id', 'prospects.user_id')
            ->select(
                'prospects.id',
                'prospects.name',
                'prospects.company',
                'prospects.email',
                'prospects.phone_number',
                'prospects.status',
                'prospects.city',
                'prospects.activity',
                'users.name as salesperson'
            )
            ->where('prospects.status', '!=', 'customer')
            ->get();

        return FastExcel::data($prospects)->download('prospects_report.xlsx');
    }

    public function allCustomers()
    {

        $customers = DB::table('customers')
            ->join('prospects', 'prospects.id', '=', 'customers.prospect_id')
            ->join('users', 'users.id', 'prospects.user_id')
            ->select(
                'customers.id',
                'prospects.name',
                'prospects.company',
                'prospects.email',
                'prospects.phone_number',
                'prospects.status',
                'prospects.city',
                'prospects.activity',
                'users.name as salesperson'
            )
            ->get();

        return FastExcel::data($customers)->download('customers_report.xlsx');
    }

    public function allAppointments()
    {

        $appointments = DB::table('appointments')
            ->join('prospects', 'prospects.id', '=', 'appointments.prospect_id')
            ->join('users', 'users.id', 'prospects.user_id')
            ->select(
                'appointments.id',
                'prospects.name',
                'prospects.company',
                'appointments.appointment_date',
                'appointments.notes',
                'appointments.outcome',
                'users.name as salesperson',
            )
            ->orderBy('appointments.appointment_date', 'desc')
            ->get();

        return FastExcel::data($appointments)->download('appointments_report.xlsx');
    }

}
