<?php
namespace App\Http\Livewire\Appointment;
use Livewire\Component;
use App\Models\Appointment;
use Livewire\WithPagination;
use App\Models\User;
use Illuminate\Support\Facades\App;

class IndexAppointment extends Component
{
use WithPagination;
public $paginationTheme="bootstrap";
public $appointmentidBeingRemoved=null;
protected $listeners=['deleteconfirmed'=>'deleteappointment'];
public $searchTitle=null;

public function render()
{
        $appointments=Appointment::query()
        ->where('id','like','%'.$this->searchTitle.'%')
        ->latest()
        ->paginate();
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
