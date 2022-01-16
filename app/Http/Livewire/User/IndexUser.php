<?php
namespace App\Http\Livewire\User;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class IndexUser extends Component
{
protected $listeners=
[
'search'=>'searchdata',    
];
public $imageurl;
public function searchdata($id)
{
$imageurl=User::where(['id'=>$id])->pluck('photo')->all();
$this->imageurl=implode($imageurl);
}

// For display data in pagination form
use WithPagination;
// For using bootstrap pagination pattern
public $paginationTheme="bootstrap";
// To receive input fields value in the form of array
public $state=[];
// We want to use one modal for adding and updating a user
public $showeditform=false;
public $searchTitle=null;
// For updating user
public $user;
// For profile image
use WithFileUploads;
public $photo;

public function render()
{
$users=User::query()
->where('name','like','%'.$this->searchTitle.'%')
->latest()
->paginate(5);
return view('livewire.user.index-user',['users'=>$users]);
}
// show dialog box for adding new user
public function adduser()
{    
    // To reset the fields 
    $this->reset();
    // To reset the page
    $this->resetPage();
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
'password_confirmation'=>'required|min:6',
])->validate();
$data['password']=bcrypt($data['password']);
if($this->photo)
{
$data['photo']=$this->photo->storeAs('userimage','profileimage.jpg','public');
}
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
$this->reset();
$this->user=$user;
$this->showeditform=true;
// Storing fields in an array
$this->state=$user->toArray();
$this->dispatchBrowserEvent('adduser');
}

// Updating user

public function updateuser()
{
// To reset the page.
$this->resetPage();
// For validations
$data=Validator::make($this->state,[
'name'=>'required',
'email'=>'required|email|unique:users,email,'.$this->user->id,
'password' => 'password' != null ?'sometimes|required|min:6': ''
])->validate();
if(!empty($data['password']))
{
$data['password']=bcrypt($data['password']);
}
if($this->photo)
{
$data['photo']=$this->photo->store('userimage','public');    
}
$this->user->update($data);
$this->dispatchBrowserEvent('hideupdateuser');
return redirect()->back();
}
// Change role of user from Admin to User
public function changeRole(User $user,$role)
{
// Validate the role
Validator::make(['role'=>$role],[
'role'=>'required|in:Admin,User',
])->validate();

$user->update(['role'=>$role]);
$this->dispatchBrowserEvent('roleupdated');
}
}
