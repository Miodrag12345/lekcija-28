<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewShipmentRequest;
use App\Http\Requests\UpdateShipmentRequest;
use App\Models\Shipments;
use Illuminate\Support\Facades\Cache;

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


    public function create()
    {
        return view('shipments.create');
    }


    public function store(NewShipmentRequest $request)
    {
        Shipments::create($request->validated());
        return redirect()->route('shipments.index');
    }


    public function show(Shipments $shipment)
    {
        return view('shipments.show', compact($shipment));
    }


    public function edit(Shipments $shipment)
    {
        return view('shipments.edit' , compact('shipment'));
    }


    public function update(UpdateShipmentRequest $request, Shipments $shipment)
    {
       $shipment->update($request->validated());
       return redirect()->back();
    }


    public function destroy(Shipments $shipments)
    {
        //
    }
}
