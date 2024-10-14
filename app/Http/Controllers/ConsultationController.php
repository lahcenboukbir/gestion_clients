<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ConsultationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $consultations = DB::table('consultations')
            ->join('customers', 'customers.id', 'consultations.customer_id')
            ->join('prospects', 'prospects.id', 'customers.prospect_id')
            ->select(
                'consultations.id as consultation_id',
                'prospects.name as customer_name',
                'consultations.status',
                'consultations.notes',
                'consultations.confirmation_date',
                'consultations.consultation_date_time',
            )
            ->get();
        // dd($consultations);
        return view('consultations.index', compact('consultations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = DB::table('customers')
            ->join('prospects', 'prospects.id', 'customers.prospect_id')
            ->select('customers.id as customer_id', 'prospects.name as customer_name')
            ->get();

        $ports = DB::table('ports')->get();
        $equipment_names = DB::table('equipment_names')->get();
        $equipment_types = DB::table('equipment_types')->get();

        return view('consultations.create', compact('customers', 'ports', 'equipment_names', 'equipment_types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'consultation_date_time' => 'nullable|date',

            'departure_port_id' => 'required|exists:ports,id',
            'arrival_port_id' => 'required|exists:ports,id',
            'departure_date_time' => 'nullable|date',
            'arrival_date_time' => 'nullable|date',

            'equipment_name_id' => 'required|exists:equipment_names,id',
            'equipment_type_id' => 'required|exists:equipment_types,id',
            'quantity' => 'required|integer',
            'serial_number' => 'nullable|integer'
        ]);

        $validated['user_id'] = auth()->id();

        $consultation_id = DB::table('consultations')->insertGetId([
            'customer_id' => $validated['customer_id'],
            'user_id' =>  $validated['user_id'],
            'consultation_date_time' =>  $validated['consultation_date_time'],
            'status' => 'scheduled',
        ]);

        DB::table('shipments')->insert([
            'consultation_id' => $consultation_id,
            'departure_port_id' => $validated['departure_port_id'],
            'arrival_port_id' => $validated['arrival_port_id'],
            'departure_date_time' => $validated['departure_date_time'],
            'arrival_date_time' => $validated['arrival_date_time'],
        ]);

        DB::table('equipments')->insert([
            'consultation_id' => $consultation_id,
            'equipment_name_id' => $validated['equipment_name_id'],
            'equipment_type_id' => $validated['equipment_type_id'],
            'quantity' => $validated['quantity'],
            'serial_number' => $validated['serial_number'],
        ]);

        return redirect()->route('consultations.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $customer = DB::table('consultations')
            ->join('customers', 'customers.id', 'consultations.customer_id')
            ->join('prospects', 'prospects.id', 'customers.prospect_id')
            ->join('users', 'users.id', 'prospects.user_id')
            ->select(
                'consultations.id',
                'prospects.name as customer_name',
                'prospects.company',
                'prospects.status',
                'users.name as user_name',
            )
            ->where('consultations.id', $id)
            ->first();

        $consultation = DB::table('consultations')
            ->where('id', $id)
            ->select('status', 'notes', 'confirmation_date', 'consultation_date_time')
            ->first();

        $port = DB::table('shipments')
            ->join('ports as departure_port', 'departure_port.id', 'shipments.departure_port_id')
            ->join('ports as arrival_port', 'arrival_port.id', 'shipments.arrival_port_id')
            ->select(
                'departure_port.port_name as departure_port',
                'arrival_port.port_name as arrival_port',
                'shipments.departure_date_time',
                'shipments.arrival_date_time',
                'shipments.duration',
                'shipments.comment',
            )
            ->where('shipments.consultation_id', $id)
            ->first();

        $equipment = DB::table('equipments')
            ->join('equipment_names', 'equipment_names.id', 'equipments.equipment_name_id')
            ->join('equipment_types', 'equipment_types.id', 'equipments.equipment_type_id')
            ->select(
                'equipment_names.equipment_name',
                'equipment_types.type_name',
                'equipments.quantity',
                'equipments.serial_number',
            )
            ->where('equipments.consultation_id', $id)
            ->first();

        return view('consultations.show', compact('customer', 'consultation', 'port', 'equipment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $customers = DB::table('customers')
            ->join('prospects', 'prospects.id', 'customers.prospect_id')
            ->select('customers.id as customer_id', 'prospects.name as customer_name')
            ->get();

        $selected_customer = DB::table('customers')
            ->join('consultations', 'consultations.customer_id', 'customers.id')
            ->select('consultations.customer_id')
            ->where('consultations.id', $id)
            ->first();

        $selected_consultation = DB::table('consultations')->where('id', $id)->first();

        $ports = DB::table('ports')->get();

        $selected_port = DB::table('shipments')
            ->join('ports as departure_port', 'departure_port.id', 'shipments.departure_port_id')
            ->join('ports as arrival_port', 'arrival_port.id', 'shipments.arrival_port_id')
            ->select(
                'departure_port.id as departure_port_id',
                'departure_port.port_name as departure_port',
                'arrival_port.id as arrival_port_id',
                'arrival_port.port_name as arrival_port',
                'shipments.consultation_id',
                'shipments.departure_date_time',
                'shipments.arrival_date_time',
                'shipments.duration',
                'shipments.comment',
            )
            ->where('shipments.consultation_id', $id)
            ->first();

        $equipment_names = DB::table('equipment_names')->get();

        $equipment_types = DB::table('equipment_types')->get();

        $equipment = DB::table('equipments')->where('consultation_id', $id)
            ->select('quantity', 'serial_number')
            ->first();

        $selected_equipment = DB::table('equipments')
            ->join('equipment_names', 'equipment_names.id', 'equipments.equipment_name_id')
            ->join('equipment_types', 'equipment_types.id', 'equipments.equipment_type_id')
            ->select(
                'equipments.equipment_name_id',
                'equipments.equipment_type_id'
            )
            ->where('equipments.consultation_id', $id)
            ->first();

        return view('consultations.edit', compact(
            'customers',
            'selected_customer',
            'selected_consultation',
            'ports',
            'selected_port',
            'equipment_names',
            'equipment_types',
            'equipment',
            'selected_equipment'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'consultation_date_time' => 'nullable|date',
            'status' =>  'required|in:scheduled,completed,canceled',
            'notes' => 'nullable|string|max:255',

            'departure_port_id' => 'required|exists:ports,id',
            'arrival_port_id' => 'required|exists:ports,id',
            'departure_date_time' => 'nullable|date',
            'arrival_date_time' => 'nullable|date',
            'duration' => 'nullable|string|max:255',
            'comment' => 'nullable|string|max:255',

            'equipment_name_id' => 'required|exists:equipment_names,id',
            'equipment_type_id' => 'required|exists:equipment_types,id',
            'quantity' => 'required|integer',
            'serial_number' => 'nullable|integer'
        ]);

        DB::table('consultations')
            ->where('id', $id)
            ->update([
                'customer_id' => $validated['customer_id'],
                'consultation_date_time' =>  $validated['consultation_date_time'],
                'status' => $validated['status'],
                'notes' => $validated['notes'],
            ]);

        DB::table('shipments')
            ->where('consultation_id', $id)
            ->update([
                'departure_port_id' => $validated['departure_port_id'],
                'arrival_port_id' => $validated['arrival_port_id'],
                'departure_date_time' => $validated['departure_date_time'],
                'arrival_date_time' => $validated['arrival_date_time'],
                'duration' => $validated['duration'],
                'comment' => $validated['comment'],
            ]);

        DB::table('equipments')
            ->where('consultation_id', $id)
            ->update([
                'equipment_name_id' => $validated['equipment_name_id'],
                'equipment_type_id' => $validated['equipment_type_id'],
                'quantity' => $validated['quantity'],
                'serial_number' => $validated['serial_number'],
            ]);

        return redirect()->route('consultations.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
