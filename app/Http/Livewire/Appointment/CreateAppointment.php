<?php
namespace App\Http\Livewire\Appointment;

use App\Models\Appointment;
use Livewire\Component;
use App\Models\Client;
use Illuminate\Support\Facades\Validator;

class CreateAppointment extends Component
{   
    public $state=[];
    public function addappointment()
    {
    $data=Validator::make($this->state,[
        'client_id'=>'required',
        'date'=>'required',
        'time'=>'required',
        'status'=>'required|in:Scheduled,Closed',
        'note'=>'sometimes',
    ])->validate();
    Appointment::create($data);
    $this->dispatchBrowserEvent('appointmentadded');
}

    public function render()
    {
    $clients=Client::all();
         return view('livewire.appointment.create-appointment',['clients'=>$clients]);
}
}
