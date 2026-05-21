<?php

namespace App\Observers;

use App\Models\Shipment;
use App\Models\Shipments;

class ShipmentObserver
{

    public function created(Shipment $shipment): void
    {
        if($shipment->status=== Shipment::STATUS_UNASSIGNED){
            Cache::forget('unassigned_shipments');
        }
    }


    public function updated(Shipment $shipment): void
    {
       Cache::forget('unassigned_shipments');
    }


    public function deleted(Shipment $shipment): void
    {
        Cache::forget('unassigned_shipments');
    }


    public function restored(Shipment $shipment): void
    {

    }


    public function forceDeleted(Shipment $shipment): void
    {

    }
}
