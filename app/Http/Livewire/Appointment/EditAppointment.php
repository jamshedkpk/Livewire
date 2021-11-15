<?php
namespace App\Http\Livewire\Appointment;

use App\Models\Appointment;
use App\Models\Client;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class EditAppointment extends Component
{
public $state=[];
public $appointment;
    public function mount(Appointment $appointment)
{
    $this->appointment=$appointment;
    $this->state=$appointment->toArray();
}

public function render()
{
$clients=Client::all();
    return view('livewire.appointment.edit-appointment',['clients'=>$clients]);
}


public function updateappointment()
{
$data=Validator::make($this->state,[
'status'=>'required|in:Scheduled,Closed',
])->validate();
$this->appointment->update($data);
$this->dispatchBrowserEvent('appointmentupdated');
}
}
