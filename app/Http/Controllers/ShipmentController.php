<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewShipmentRequest;
use App\Http\Requests\UpdateShipmentRequest;
use App\Models\Shipments;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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
            fn()=>Shipments::unassignedShipments()->get());



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

    public function assignUser (Request $request, Shipment $shipment ):RedirectResponse
    {


        $request->validate(['user_id'=>'required|exists:users,id']);

        $shipment->user_id =$request->user_id;
        $shipment->status=Shipment ::STATUS_IN_PROGRESS;
        $shipment->save();

        Cache::forget('unassigned_shipments');

         return  redirect()->back();
    }
}
