<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use App\Http\Requests\NewShipmentRequest;
use App\Models\Shipments;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Cache::forget('unassigned_shipments');
        $shipments=Cache::remember('unassigned_shipments',600,
            fn()=>Shipments::where(['status'=>Shipments::STATUS_UNASSIGNED])->get());



        return view('shipments.index',[
            'shipments'=>$shipments
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('shipments.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(NewShipmentRequest $request)
    {
        Shipments::create($request->validated());
        return redirect()->route('shipments.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Shipments $shipment)
    {
        return view('shipments.show', compact($shipment));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Shipments $shipment)
    {
        return view('shipments.edit' , compact('shipment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Shipments $shipments)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Shipments $shipments)
    {
        //
    }
}
