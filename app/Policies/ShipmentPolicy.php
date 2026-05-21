<?php

namespace App\Policies;

use App\Models\Shipment;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ShipmentPolicy
{

    public function viewAny(User $user): bool
    {
        return false;
    }


    public function view(User $user, Shipment $shipment): bool
    {
        return $user->role === User::ROLE_ADMINISTRATOR || $shipment->client_id===$user->id;
    }


    public function create(User $user): bool
    {

           return $user->role === User::ROLE_ADMINISTRATOR;
    }


    public function update(User $user, Shipment $shipment): bool
    {
        return false;
    }


    public function delete(User $user, Shipment $shipment): bool
    {
        return false;
    }


    public function restore(User $user, Shipment $shipment): bool
    {
        return false;
    }


    public function forceDelete(User $user, Shipment $shipment): bool
    {
        return false;
    }

    public function canViewCreationPage(User $user):bool
    {
        return $user->role === User::ROLE_ADMINISTRATOR;
    }

    public function  canViewEdit(user $user):bool
    {
        return $user->role === User::ROLE_ADMINISTRATOR;
    }
}
