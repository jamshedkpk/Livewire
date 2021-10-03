<div>
  
<style>
.table tr th,
.table tr td
{
text-align: center;
color:#343A40;   
}
</style>
<br>

<div class="container">

<div class="row">
<div class="col-md-12">

<button wire:click.prevent="adduser" class="btn btn-primary text-light float-right btn-sm">
<span class="fa fa-plus-circle"></span> 
&nbsp;   
Add New User</button>    

</div>
</div>
<!-- End of row-->
<br>
<div class="card">
<div class="card-header d-block text-center bg-primary">
<h5>
Welcome To The User Section
</h5>
</div>
<div class="card-body">
<table class="table table-bordered table-stripped table-hover">
<thead>
<tr>
<th>ID</th>
<th>Name</th>
<th>Email</th>
<th colspan="2">Action</th>
</tr>
</thead>
<tbody>
@foreach($users as $user)
<tr>
<td>
{{$user->id}}
</td>
<td>
{{$user->name}}
</td>
<td>
{{$user->email}}
</td>
<td>
<a href="" wire:click.prevent="edit({{$user}})">
<span class="fa fa-edit"></span>    
</a>
</td>
<td>
<a href="" wire:click.prevent="confirmdeleteuser({{$user->id}})">
<span class="fa fa-trash"></span>    
</a>
</td>
</tr>
@endforeach
</tbody>
</table>
</div>
<div class="card-footer">
{{$users->links()}}
</div>
</div>

<!--End of row-->

</div>
<!--End of container-->
<!-- Modal for adding new user-->
<div class="modal" tabindex="-1" role="dialog" id="modaluseradd" wire:ignore.self>
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Welcome To The New User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
    <form wire:submit.prevent="{{$showeditform? 'updateuser':'addnewuser'}}">
    <div class="form-group">
    <input wire:model.defer="state.name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Enter Your Name">
    @error('name')
    <div class="invalid-feedback">
    {{$message}}
  </div>  
  @enderror
  </div>    
    <div class="form-group">
    <input wire:model.defer="state.email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter Your Email">
    @error('email')
    <div class="invalid-feedback">
    {{$message}}
    </div>
    @enderror
  </div>    
    <div class="form-group">
    <input wire:model.defer="state.password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Enter Your Password">
    @error('password')
    <div class="invalid-feedback">
    {{$message}}
    </div>
    @enderror
    </div>    
    <div class="form-group">
    <input wire:model.defer="state.password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Confirm Your Password">
    @error('password_confirmation')  
    <div class="invalid-feedback">
    {{$message}}
    </div>
    @enderror
  </div>    
    </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">
        <span class="fa fa-times-circle mr-2">
        </span>    
        Close</button>
        @if($showeditform)
        <button type="submit" class="btn btn-primary">
        <span class="fa fa-edit mr-2">
        </span>    
        Update User
        </button>
        @else
        <button type="submit" class="btn btn-primary">
        <span class="fa fa-plus-circle mr-2">
        </span>    
        Add User
        </button>
        @endif  
        
      </div>
      </form>
    </div>
  </div>
</div>
<!-- Model for confirmation to delete a user-->
<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="confirmdeleteuser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete The User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete the user        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">
        <span class="fa fa-times"></span>  
        &nbsp;
        Close</button>
        <button wire:click="deleteuser" type="button" class="btn btn-primary">
        <span class="fa fa-trash"></span>  
        &nbsp; 
        Delete User</button>
      </div>
    </div>
  </div>
</div>

<script>
// To display modal for adding new user
window.addEventListener('adduser',event=>{
$('#modaluseradd').modal('show');
});
</script>
<script>

// To hide add user model
window.addEventListener('hideadduser',event=>{
$('#modaluseradd').modal('hide');
// To show sweat alert for success adding user
Swal.fire({
  position: 'top-center',
  icon: 'success',
  iconColor:'green',
  title: 'User is successfully Added',
  timerProgressBar:true,
  showConfirmButton: false,
  timer: 2000
});
});
</script>

<script>
// Confirm delete user
window.addEventListener('confirmdeleteuser',event=>{
$('#confirmdeleteuser').modal('show');
});
</script>

<script>
// Hide delete model and show sweat alert
window.addEventListener('hidedeletemodal',event=>{
$('#confirmdeleteuser').modal('hide');
const Toast = Swal.mixin({
  toast: true,
  position: 'top-center',
  showConfirmButton: false,
  iconColor:'green',
  timer: 3000,
  timerProgressBar: true,
  progressBarColor:'green',
  didOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
})

Toast.fire({
  icon: 'success',
  title: 'User is successfully Deleted'
});
});
</script>

<script>
// Show update model and sweat alert in case of success updation
window.addEventListener('hideupdateuser',event=>{
  $('#modaluseradd').modal('hide');

  const Toast = Swal.mixin({
  toast: true,
  position: 'top-center',
  showConfirmButton: false,
  iconColor:'green',
  customClass:'simple',
  timer: 2000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
})

Toast.fire({
  icon: 'success',
  title: 'User is successfully Updated'
});

});
</script>
<style>
.simple
{
background-color: red;  
}
</style>
</div>
<!--End of component-->