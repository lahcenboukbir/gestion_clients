<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PortController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ports = DB::table('ports')->get();

        return view('ports.index', compact('ports'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ports.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'port_name' => 'required|string|max:255'
        ]);

        $validated['created_at'] = now();
        $validated['updated_at'] = now();

        DB::table('ports')->insert($validated);

        return redirect()->route('ports.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $port = DB::table('ports')->where('id', $id)->first();

        return view('ports.edit', compact('port'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'port_name' => 'required|string|max:255'
        ]);

        $validated['updated_at'] = now();

        DB::table('ports')->where('id', $id)->update($validated);

        return redirect()->route('ports.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $port = DB::table('ports')->where('id', $id)->first();

        if ($port) {
            DB::table('ports')->where('id', $id)->delete();

            return redirect()->route('ports.index');
        }
    }
}
