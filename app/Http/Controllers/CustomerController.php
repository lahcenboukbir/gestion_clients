<?php

namespace App\Http\Controllers;

use App\Models\Prospect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
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
            $customers = DB::table('customers')
            ->join('prospects', 'prospects.id', '=', 'customers.prospect_id')
            ->select('prospects.name', 'prospects.company', 'prospects.email', 'prospects.phone_number', 'customers.id')
            ->get();
        } else {
            $customers = DB::table('customers')
            ->join('prospects', 'prospects.id', '=', 'customers.prospect_id')
            ->select('prospects.name', 'prospects.company', 'prospects.email', 'prospects.phone_number', 'customers.id')
            ->where('prospects.user_id', $user->id)
            ->get();
        }

        return view('customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = auth()->user();

        if ($user->hasRole('admin')) {
            $customer = DB::table('customers')
            ->join('prospects', 'prospects.id', '=', 'customers.prospect_id')
            ->join('users', 'users.id', '=', 'prospects.user_id')
            ->select(
                'users.name as user_name',
                'prospects.name',
                'prospects.company',
                'prospects.email',
                'prospects.phone_number',
                'prospects.status',
                'prospects.city',
                'prospects.activity',
                'prospects.comment',
                'customers.id',
                'customers.created_at',
            )
            ->where('customers.id', $id)
            ->first();
        } else {
            $customer = DB::table('customers')
            ->join('prospects', 'prospects.id', '=', 'customers.prospect_id')
            ->join('users', 'users.id', '=', 'prospects.user_id')
            ->select(
                'users.name as user_name',
                'prospects.name',
                'prospects.company',
                'prospects.email',
                'prospects.phone_number',
                'prospects.status',
                'prospects.city',
                'prospects.activity',
                'prospects.comment',
                'prospects.user_id',
                'customers.id',
                'customers.created_at',
            )
            ->where('customers.id', $id)
            ->where('prospects.user_id', $user->id)
            ->first();
        }

        return view('customers.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        $customer = DB::table('customers')->where('id', $id)->first();

        if ($customer) {
            DB::table('customers')->where('id', $id)->delete();

            // Update the status of the related prospect to 'new' based on the prospect_id from the customer
            DB::table('prospects')->where('id', $customer->prospect_id)->update(['status' => 'new']);
        }

        return redirect()->route('customers.index');
    }
}
