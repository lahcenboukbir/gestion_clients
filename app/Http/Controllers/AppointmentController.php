<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AppointmentController extends Controller
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
        $appointments = DB::table('appointments')
            ->join('prospects', 'prospects.id', '=', 'appointments.prospect_id')
            ->select(
                'prospects.id',
                'prospects.name',
                'prospects.company',
                'prospects.email',
                'prospects.phone_number',
                DB::raw('COUNT(appointments.id) as total_appointments'),
                'appointments.notes',
            )
            ->groupBy(
                'prospects.id',
                'prospects.name',
                'prospects.company',
                'prospects.email',
                'prospects.phone_number',
                'appointments.notes',
            )
            ->having('total_appointments', '>', 0)
            ->get();


        $latestAppointments = DB::table('appointments')
            ->join('prospects', 'prospects.id', '=', 'appointments.prospect_id')
            ->select(
                'prospects.id',
                'prospects.name',
                'prospects.company',
                'prospects.email',
                'prospects.phone_number',
                'appointments.appointment_date',
                'appointments.notes'
            )
            ->whereRaw('appointments.appointment_date = (SELECT MAX(a2.appointment_date) FROM appointments a2 WHERE a2.prospect_id = appointments.prospect_id)')
            ->get();

        return view('appointments.index', compact('appointments', 'latestAppointments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $prospects = DB::table('prospects')->where('status', '!=', 'customer')->get();

        return view('appointments.create', compact('prospects'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'appointment_date' => 'required|date',
            'prospect_id' => 'required|exists:prospects,id',
        ]);

        $validated['created_at'] = now();
        $validated['updated_at'] = now();

        $validated['user_id'] = auth()->id();

        DB::table('appointments')->insert($validated);

        return redirect()->route('appointments.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $appointments = DB::table('appointments')
            ->where('prospect_id', $id)
            ->orderBy('appointment_date', 'desc')
            ->get();

        $prospect_name = DB::table('prospects')->select('name')->where('id', $id)->first();

        return view('appointments.show', compact('appointments', 'prospect_name'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $appointment = DB::table('appointments')->where('id', $id)->orderBy('appointment_date', 'desc')->first();

        return view('appointments.edit', compact('appointment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'appointment_date' => 'required|date',
            'notes' => 'nullable|string',
            'outcome' => 'nullable|in:success,fail,pending',
        ]);

        $validated['updated_at'] = now();

        DB::table('appointments')->where('id', $id)->update($validated);

        // ** **

        $appointment = DB::table('appointments')->where('id', $id)->first();

        if (!$appointment) {
            return redirect()->route('prospects.index');
        }

        switch ($validated['outcome']) {
            case 'success':
                DB::table('customers')->insert([
                    'prospect_id' => $appointment->prospect_id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                DB::table('prospects')->where('id', $appointment->prospect_id)->update([
                    'status' => 'customer'
                ]);
                break;

            case 'fail':
                DB::table('prospects')->where('id', $appointment->prospect_id)->update([
                    'status' => 'not_interested'
                ]);
                break;

            case 'pending':
                DB::table('prospects')->where('id', $appointment->prospect_id)->update([
                    'status' => 'new'
                ]);
                break;
        }

        // If outcome is not 'success', check if the customer exists and delete if needed
        if ($validated['outcome'] !== 'success') {
            DB::table('customers')->where('prospect_id', $appointment->prospect_id)->delete();

            return redirect()->route('appointments.index');
        }

        return redirect()->route('appointments.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        $appointment = DB::table('appointments')->where('id', $id)->first();

        if ($appointment) {
            DB::table('appointments')->where('id', $id)->delete();

            return redirect()->route('appointments.index');
        }
    }
}
