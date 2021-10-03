<?php
namespace App\Http\Livewire\User;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithPagination;

class IndexUser extends Component
{
// For display data in pagination form
use WithPagination;
// For using bootstrap pagination pattern
public $paginationTheme="bootstrap";
// To receive input fields value in the form of array
public $state=[];

public function render()
{
$users=User::latest()->paginate(5);
return view('livewire.user.index-user',['users'=>$users]);
}
// show dialog box for adding new user
public function adduser()
{
$this->dispatchBrowserEvent('adduser');
}
// add and validate new user
public function addnewuser()
{
$data=Validator::make($this->state,[
'name'=>'required',
'email'=>'required|email|unique:users',
'password'=>'required|min:6|confirmed',
'password_confirmation'=>'required|min:6'
])->validate();
User::create($data);
$this->dispatchBrowserEvent('hideadduser');
return redirect()->back();
}

public $useridbeingremoved=null;
// confirm delete user
public function confirmdeleteuser($userid)
{
$this->useridbeingremoved=$userid;
$this->dispatchBrowserEvent('confirmdeleteuser');
}
// Delete the user
public function deleteuser()
{
$user=User::where(['id'=>$this->useridbeingremoved]);
$user->delete();
$this->dispatchBrowserEvent('hidedeletemodal');
}
}
