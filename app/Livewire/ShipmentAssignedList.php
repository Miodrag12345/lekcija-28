<?php

namespace  App\Livewire;

use Livewire\Component;

class ShipmentAssignedList extends Component
{

    public int $count=0;

    public int $amount=1;

    public string  $errorMessage="";

    public function render()
    {
        return view('livewire.shipment-assigned-list');
    }

    public function increment()
    {
         $this->count += $this->amount;
         $this->errorMessage = "";
    }

    public function decrement()
    {
      $result = $this->count-$this->amount;
      if($result >= 0){
          $this->count -= $this->amount;
      } else {
          $this->errorMessage ="Invalid math operation,it will go under 0 ";
      }
    }
}
