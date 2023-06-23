<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $items = \App\Models\Item::all();

        $billCount = \App\Models\BillHeader::count() + 1;

        return view('bill', compact('items', 'billCount'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function addcustomer(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'city' => 'required',
        ]);

        if (\App\Models\Costumer::where('name', $request->name)->exists()) {
            return response()->json(['customer' => \App\Models\Costumer::where('name', $request->name)->first()]);
        }
        else {
            $customer = \App\Models\Costumer::create([
                'name' => $request->name,
                'address' => $request->address,
                'city' => $request->city,

            ]);

            return response()->json(['customer' => $customer]);
        }



    }


    public function store(Request $request)
    {


        // dd ($request->all());

        $request->validate([
            'costumer_id' => 'required',
            'item' => 'required',
            'rate' => 'required',
            'quantity' => 'required',
            'total_amount' => 'required',
        ]);

        $billHeader = \App\Models\BillHeader::create([
            'costumer_id' => $request->costumer_id,
            'total_amount' => $request->total_amount,
        ]);

        foreach ($request->item as $key => $item) {
            \App\Models\BillDetail::create([
                'bill_header_id' => $billHeader->id,
                'item_id' => $item,
                'rate' => $request->rate[$key],
                'quantity' => $request->quantity[$key],
                'amount' => $request->amount[$key],
            ]);
        }


        return redirect(route('bill.create'))->with('success', 'Bill created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
