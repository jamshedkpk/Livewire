<?php
namespace App\Http\Livewire\Appointment;
use Livewire\Component;
use App\Models\Appointment;
use Livewire\WithPagination;

class IndexAppointment extends Component
{
use WithPagination;
public $paginationTheme="bootstrap";
public $appointmentidBeingRemoved=null;
protected $listeners=['deleteconfirmed'=>'deleteappointment'];

public function render()
{
$appointments=Appointment::latest()->paginate(5);
return view('livewire.appointment.index-appointment',['appointments'=>$appointments]);
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
