<div>
<x-loading-indicator/>
<style>
.table tr th,
.table tr td {
text-align: center;
color: #343A40;
vertical-align: middle;
}
</style>
<div class="container" style="margin-top:5px;">
<div class="row">
<div class="col-md-4">
<button wire:click.prevent="adduser" class="btn btn-success text-light float-left">
<span class="fa fa-plus-circle mr-2"></span>
Add New User</button>
</div>

<div class="col-md-4"></div>
<div class="col-md-4">
<div class="input-group">
<!-- To search on the basis of name-->
<input wire:model="searchTitle" type="text" class="form-control float-right bg-dark text-light border:0" placeholder="Search Here....">
<span class="input-group-append">
<span class="input-group-text">
<!-- To implement loading-->
<div wire:loading>
<div class="spinner-border text-success spinner-border-sm" role="status">
<span class="sr-only">Loading...</span>
</div>
</div>
<!-- To remove loading-->
<div wire:loading.remove>
<span class="fa fa-search">
</span>
</div>
</div>
</span>
</span>
</div>
</div>
<!-- End of row-->
<div class="card card-success" style="margin-top:5px;">
<div class="card-header">
<div class="card-title">
<h5>
Welcome To The User Section
</h5>
</div>
<div class="card-tools">
<button type="button" class="btn btn-tool" data-card-widget="card-refresh" data-source="widgets.html" data-source-selector="#card-refresh-content" data-load-on-init="false">
<i class="fas fa-sync-alt"></i>
</button>
<button type="button" class="btn btn-tool" data-card-widget="maximize">
<i class="fas fa-expand"></i>
</button>
<button type="button" class="btn btn-tool" data-card-widget="collapse">
<i class="fas fa-minus"></i>
</button>
<button type="button" class="btn btn-tool" data-card-widget="remove">
<i class="fas fa-times"></i>
</button>
</div>
</div>
<div class="card-body">
<table class="table table-bordered table-stripped table-hover">
<thead>
<tr>
<th>ID</th>
<th>Image</th>
<th>Name</th>
<th>Email</th>
<th>Registered Date</th>
<th>Role</th>
<th colspan="2">Action</th>
</tr>
</thead>
<tbody>
@forelse($users as $user)
<tr>
<td>
{{$user->id}}
</td>
<td>
<div class="img-thumbnail">
<img src="{{url('/storage/'.$user->photo)}}" style="border-radius:5px;" height="50px" width="50px;" alt="">
</div>
</td>
<td>
{{$user->name}}
</td>
<td>
{{$user->email}}
</td>
<td>
{{$user->created_at->toFormattedDate()}}
</td>
<td>
<select class="form-control" wire:change="changeRole({{$user}},$event.target.value)">
<option value="Admin" {{($user->role=='Admin')?'selected':''}}>
Admin
</option>
<option value="User" {{($user->role=='User')?'selected':''}}>
User
</option>
</select>
</td>
<td>
<a href=""  wire:click.prevent="edit({{$user}})" wire:click="$emit('search',{{$user->id}})">
<span class="fa fa-edit"></span>
</a>
</td>
<td>
<a href="" wire:click.prevent="confirmdeleteuser({{$user->id}})">
<span class="fa fa-trash"></span>
</a>
</td>
</tr>
@empty
<div>
<tr class="bg-success">
<td colspan="6">
<img src="{{asset('Assets/Images/Empty.png')}}" alt="" height="100" width="100" style="border-radius:10px;">
<h5 class="text-dark">Record Not Found</5>
</td>
</tr>
</div>
@endforelse
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
<div class="form-group">
<label for="">Profile Photo</label>
<!-- When photo is uploaded then display it directly-->
@if($photo)
<img style="padding:5px;" class="img img-circle" height="50px;" width="50px;" src="{{$photo->temporaryUrl()}}" alt="">
@else
@endif
<div class="custom-file">
<div x-data="{ isUploading: false, progress: 0 }"
     x-on:livewire-upload-start="isUploading=true"
     x-on:livewire-upload-finish="isUploading=false,progress=0"
     x-on:livewire-upload-error="isUploading=false"
     x-on:livewire-upload-progress="progress=$event.detail.progress"
>
<input wire:model="photo" type="file" id="custom-file" class="custom-file-input @error('photo') is-invalid @enderror"> 
<div x-show.transition="isUploading" class="progress mt-2 rounded">
<div class="progress-bar bg-primary progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" x-bind:style="`width:${progress}%`">
<span class="sr-only">40% Complete (success)</span>
</div>
</div>
</div>

<!-- If photo is uploaded then display the name else not-->     
<label for="custom-file" class="custom-file-label" >
@if($photo)
<!-- To get original name of the uploaded file-->
{{$photo->getClientOriginalName()}}
@else
Choose File 
@endif
</label>
<!-- If their is an error in photo-->
@error('photo')
<div class="invalid-feedback">
{{$message}}
</div>
@enderror
</div>
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
Are you sure you want to delete the user ...
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
window.addEventListener('adduser', event => {
$('#modaluseradd').modal('show');
});
</script>
<script>
// To hide add user model
window.addEventListener('hideadduser', event => {
$('#modaluseradd').modal('hide');
// To show sweat alert for success adding user
Swal.fire({
position: 'top-center',
icon: 'success',
iconColor: 'green',
title: 'User is successfully Added',
timerProgressBar: true,
showConfirmButton: false,
timer: 2000
});
});
</script>
<script>
// Confirm delete user
window.addEventListener('confirmdeleteuser', event => {
$('#confirmdeleteuser').modal('show');
});
</script>
<script>
// Hide delete model and show sweat alert
window.addEventListener('hidedeletemodal', event => {
$('#confirmdeleteuser').modal('hide');
const Toast = Swal.mixin({
toast: true,
position: 'top-center',
showConfirmButton: false,
iconColor: 'green',
timer: 3000,
timerProgressBar: true,
progressBarColor: 'green',
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
window.addEventListener('hideupdateuser', event => {
$('#modaluseradd').modal('hide');

const Toast = Swal.mixin({
toast: true,
position: 'top-center',
showConfirmButton: false,
iconColor: 'green',
customClass: 'simple',
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
.simple {
background-color: red;
}
</style>
<script>
// Hide delete model and show sweat alert
window.addEventListener('roleupdated', event => {
$('#confirmdeleteuser').modal('hide');
const Toast = Swal.mixin({
toast: true,
position: 'top-center',
showConfirmButton: false,
iconColor: 'green',
timer: 3000,
timerProgressBar: true,
progressBarColor: 'green',
didOpen: (toast) => {
toast.addEventListener('mouseenter', Swal.stopTimer)
toast.addEventListener('mouseleave', Swal.resumeTimer)
}
})

Toast.fire({
icon: 'success',
title: 'Role Is Successfully Updated'
});
});

</script>
</div>
<!--End of component-->