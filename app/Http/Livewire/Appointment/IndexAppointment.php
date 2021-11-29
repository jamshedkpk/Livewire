<?php
namespace App\Http\Livewire\Appointment;
use Livewire\Component;
use App\Models\Appointment;
use Livewire\WithPagination;
use App\Models\User;
use App\Models\Client;
use Illuminate\Contracts\Validation\Validator as ValidationValidator;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;

class IndexAppointment extends Component
{
public $state=[];
// Use for pagination
use WithPagination;
// Use for bootstrap pagination 
public $paginationTheme="bootstrap";
/*
We create a variable, store null in it 
If someone click on delete button then id is sent
And stored in it
*/
public $appointmentidBeingRemoved=null;
/*
When deleteconfirmed event is performed then deleteappointment method is called
*/
protected $listeners=['deleteconfirmed'=>'deleteappointment'];
/*
We declare a variable for search and its
Initial value is null if someone search 
Then its value is equal to the search value
*/
public $searchTitle=null;

/*
We declare a variable for status Its initial value is null
If someone wants to check appointments by filtering 
Then Status is sent from the button and its value is equal to 
The sent value
*/
public $status=null;
/*
We define a function for filtering , pass a status
*/
public function filterStatus($status=null)
{
// Page should be reset directly if someone click on Filtering Button
$this->resetPage();
$this->status=$status;
}

/*
We define a function for searching appointments
*/
public function searchdata($searchTitle)
{
$this->searchTitle=$searchTitle;    
}

public function render()
{   
/*
Select all record of appointment with client function.
In client function inside appointments model we link client and appointment table
*/
$appointments=Appointment::With('client')
// If someone wants to filter Closed or Scheduled appointments
->when($this->status,function($query,$status){
return $query->where('status',$status);
})
->latest()
->paginate(5);

$appointmentTotal=Appointment::count();
$appointmentScheduled=Appointment::where(['status'=>'Scheduled'])->count();
$appointmentClosed=Appointment::where(['status'=>'Closed'])->count();

return view('livewire.appointment.index-appointment',['appointments'=>$appointments,'appointmentTotal'=>$appointmentTotal,'appointmentScheduled'=>$appointmentScheduled,'appointmentClosed'=>$appointmentClosed]);
}

// To confirm delete an appointment
public function confirmdeleteappointment($id)
{
$this->appointmentidBeingRemoved=$id;
$this->dispatchBrowserEvent('confirmdeleteappointment');
}
// To delete the appointment
public function deleteappointment()
{
$appointment=Appointment::where(['id'=>$this->appointmentidBeingRemoved]);
$appointment->delete();
$this->dispatchBrowserEvent('deletedappointment');
}
}