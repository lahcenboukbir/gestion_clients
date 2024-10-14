<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EquipementTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $equipments = DB::table('equipment_types')->get();

        return view('equipment-types.index', compact('equipments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('equipment-types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'type_name' => 'required|string|max:255'
        ]);

        $validated['created_at'] = now();
        $validated['updated_at'] = now();

        DB::table('equipment_types')->insert($validated);

        return redirect()->route('equipment.types.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $equipment = DB::table('equipment_types')->where('id', $id)->first();

        return view('equipment-types.edit', compact('equipment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'type_name' => 'required|string|max:255'
        ]);

        $validated['updated_at'] = now();

        DB::table('equipment_types')->where('id', $id)->update($validated);

        return redirect()->route('equipment.types.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $equipment = DB::table('equipment_types')->where('id', $id)->first();

        if ($equipment) {
            DB::table('equipment_types')->where('id', $id)->delete();

            return redirect()->route('equipment.types.index');
        }
    }
}
