<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProspectController extends Controller
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
        $user = auth()->user();

        if ($user->hasRole('admin')) {
            $prospects = DB::table('prospects')->where('status', '!=', 'customer')->get();
        } else {
            $prospects = DB::table('prospects')
                ->where('status', '!=', 'customer')
                ->where('user_id', $user->id)
                ->get();
        }

        return view('prospects.index', compact('prospects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = DB::table('users')->get();

        return view('prospects.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'email' => 'required|email|unique:prospects,email',
            'phone_number' => 'nullable|string|max:20',
            'status' => 'required|in:new,interested,not_interested,customer',
            'appointment_date' => 'required|date',
            'city' => 'nullable|string|max:255',
            'activity' => 'nullable|string|max:255',
            'comment' => 'nullable|string|max:255',
        ]);

        $validated['user_id'] = auth()->id();

        // Insert into the prospects table and get the prospect ID
        $prospectId = DB::table('prospects')->insertGetId([
            'name' => $validated['name'],
            'company' => $validated['company'],
            'email' => $validated['email'],
            'phone_number' => $validated['phone_number'],
            'status' => $validated['status'],
            'user_id' => $validated['user_id'],
            'city' => $validated['city'],
            'activity' => $validated['activity'],
            'comment' => $validated['comment'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Insert the appointment record into the appointments table
        DB::table('appointments')->insert([
            'prospect_id' => $prospectId,
            'user_id' => $validated['user_id'], // Same user_id as the prospect
            'appointment_date' => $validated['appointment_date'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Insert a new record into the 'customers' table if the validated status is 'customer'
        if ($validated['status'] === 'customer') {
            DB::table('customers')->insert([
                'prospect_id' => $prospectId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return redirect()->route('prospects.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = auth()->user();

        if ($user->hasRole('admin')) {
            $prospect = DB::table('prospects')
                ->join('users', 'users.id', 'prospects.user_id')
                ->select(
                    'prospects.name',
                    'prospects.company',
                    'prospects.status',
                    'prospects.email',
                    'prospects.city',
                    'prospects.phone_number',
                    'prospects.activity',
                    'users.id as user_id',
                    'users.name as user_name'
                )
                ->where('prospects.id', $id)
                ->first();

            $appointments = DB::table('appointments')
                ->where('prospect_id', $id)
                ->orderBy('appointment_date')
                ->get();
        } else {
            $prospect = DB::table('prospects')
                ->join('users', 'users.id', 'prospects.user_id')
                ->select(
                    'prospects.name',
                    'prospects.company',
                    'prospects.status',
                    'prospects.email',
                    'prospects.city',
                    'prospects.phone_number',
                    'prospects.activity',
                    'users.id as user_id',
                    'users.name as user_name'
                )
                ->where('prospects.id', $id)
                ->where('prospects.user_id', $user->id)
                ->first();

            $appointments = DB::table('appointments')
                ->where('prospect_id', $id)
                ->where('user_id', $user->id)
                ->orderBy('appointment_date')
                ->get();
        }

        return view('prospects.show', compact('prospect', 'appointments'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = auth()->user();

        if ($user->hasRole('admin')) {
            $prospect = DB::table('prospects')
                ->where('id', $id)
                ->first();
        } else {
            $prospect = DB::table('prospects')->where('id', $id)
                ->where('prospects.user_id', $user->id)
                ->first();
        }
        return view('prospects.edit', compact('prospect'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'email' => 'required|email',
            'phone_number' => 'nullable|string|max:20',
            'status' =>  'required|in:new,interested,not_interested,customer',
            'city' => 'nullable|string|max:255',
            'activity' => 'nullable|string|max:255',
            'comment' => 'nullable|string|max:255',
        ]);

        $validated['updated_at'] = now();

        DB::table('prospects')->where('id', $id)->update($validated);

        // ** **

        $appointment = DB::table('appointments')->where('prospect_id', $id)->first();

        if (!$appointment) {
            return redirect()->route('prospects.index');
        }

        if ($validated['status'] === 'customer') {
            // If the prospect's status is updated to 'customer', insert a new record into the customers table
            DB::table('customers')->insert([
                'prospect_id' => $id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Update the outcome of the appointment to 'success' since the prospect became a customer
            DB::table('appointments')->where('id', $appointment->id)->update([
                'outcome' => 'success'
            ]);

            return redirect()->route('customers.index');
        }

        if ($validated['status'] !== 'customer') {
            // If the status is changed from 'customer' to something else, delete the corresponding customer record
            DB::table('customers')->where('prospect_id', $id)->delete();

            // Update the appointment outcome to 'pending' as the prospect is no longer a customer
            DB::table('appointments')->where('id', $appointment->id)->update([
                'outcome' => 'pending'
            ]);
        }

        return redirect()->route('prospects.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $prospect = DB::table('prospects')->where('id', $id)->first();

        if ($prospect) {
            DB::table('prospects')->where('id', $id)->delete();
        }

        return redirect()->route('prospects.index');
    }
}
