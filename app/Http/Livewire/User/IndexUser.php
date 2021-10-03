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

// We want to use one modal for adding and updating a user
public $showeditform=false;
public $user;
public function render()
{
$users=User::latest()->paginate(5);
return view('livewire.user.index-user',['users'=>$users]);
}
// show dialog box for adding new user
public function adduser()
{    
    $this->showeditform=false;
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
$data['password']=bcrypt($data['password']);
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

// Edit the user
public function edit(User $user)
{
$this->user=$user;
    $this->showeditform=true;
// Storing fields in an array
$this->state=$user->toArray();
$this->dispatchBrowserEvent('adduser');
}
// Updating user
public function updateuser()
{
    $data=Validator::make($this->state,[
        'name'=>'required',
        'email'=>'required|email|unique:users,email,'.$this->user->id,
        'password'=>'sometimes|confirmed',
        ])->validate();
        if(!empty($data['password']))
        {
        $data['password']=bcrypt($data['password']);
        }
        $this->user->update($data);
        $this->dispatchBrowserEvent('hideupdateuser');
        return redirect()->back();
}

}
