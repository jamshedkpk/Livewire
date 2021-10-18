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

// To check status
public $status=null;
// To filter by status
public function filterStatus($status=null)
{
$this->resetPage();
$this->status=$status;
}

// For search 
public function searchdata($searchTitle)
{
$this->searchTitle=$searchTitle;    
}

public function render()
{   
    /*
Select all record of appointment with client function in which it is linked 
To a Client table, When we want to search by status then if status is available
Then search by status else search all record....
*/
$appointments=Appointment::With('client')
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
