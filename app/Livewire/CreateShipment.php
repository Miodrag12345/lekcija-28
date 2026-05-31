<?php

namespace App\Livewire;

use App\Http\Requests\NewShipmentRequest;
use App\Services\ShipmentService;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateShipment extends Component
{

    use WithFileUploads;

    public string $title;

    public string $fromCity;

    public string $fromCountry;

    public string $toCity;

    public string $toCountry;

    public int $price;

    public array $statuses =[];

    public string $status;

    public int $clientId;

    public string $clientError;

    public array $documents;
    public string $details;



    public function validateUser()
    {
       //$user= User::firstWhere('id', $this->clientId);

       //$this->clientError="";
       //if(!$user){
       //    $this->clientError="Ovaj korisnik ne postoji";
       //}

       $this->validate([
          'clientId' => 'required|integer|exists:users,id',

       ]);

    }

    public function render()
    {
        return view('livewire.create-shipment');
    }

    public function mount()
    {
       $this->statuses = Shipment ::ALLOWED_STATUSES;
    }

    public function submit (ShipmentService $shipmentService)
    {
        $request=new NewShipmentRequest();
        $data=$this->validate($request->rules());

        $data['from_city']= $this->fromCity;
        $data['to_city']= $this->toCity;
        $data['from_country']=$this->fromCountry;
        $data['to_country']=$this->toCountry;
        $data['client_id']=$this->clientId;

        $shipmentService->store($data);

    }
}

