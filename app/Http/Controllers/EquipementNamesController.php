<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EquipementNamesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $equipments = DB::table('equipment_names')->get();

        return view('equipment-names.index', compact('equipments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('equipment-names.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'equipment_name' => 'required|string|max:255'
        ]);

        $validated['updated_at'] = now();
        $validated['created_at'] = now();

        DB::table('equipment_names')->insert($validated);

        return redirect()->route('equipment.names.index');
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
        $equipment = DB::table('equipment_names')->where('id', $id)->first();

        return view('equipment-names.edit', compact('equipment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'equipment_name' => 'required|string|max:255'
        ]);

        $validated['updated_at'] = now();

        DB::table('equipment_names')->where('id', $id)->update($validated);

        return redirect()->route('equipment.names.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $equipment = DB::table('equipment_names')->where('id', $id)->first();

        if ($equipment) {
            DB::table('equipment_names')->where('id', $id)->delete();

            return redirect()->route('equipment.names.index');
        }
    }
}
