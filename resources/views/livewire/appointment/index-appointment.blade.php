<div class="container" style="margin-top:5px;">
<x-loading-indicator/>
<style>
.table tr td,
.table,
tr th {
text-align: center;
}
</style>

<div class="row">
<div class="col-md-3">
<a href="{{route('createappointment')}}">
<button class="btn btn-success">
<span class="fa fa-plus-circle mr-2"></span>
Add New
</button>
</a>
</div>
<div class="col-md-6 text-center">
<div class="btn-group">
<button wire:click="filterStatus" type="button" class="btn {{is_null($status)?'btn-danger':'btn-default'}}">
<span class="mr-1">
All
</span>
<span class="badge badg-pill badge-info">
{{$appointmentTotal}}
</span>
</button>
<button wire:click="filterStatus('Scheduled')" type="button" class="btn {{($status=='Scheduled')? 'btn-danger':'btn-default'}}">
<span class="mr-1">Scheduled</span>
<span class="badge badg-pill badge-warning">
{{$appointmentScheduled}}
</span>
</button>
<button wire:click="filterStatus('Closed')" type="button" class="btn {{($status=='Closed')? 'btn-danger':'btn-default'}}">
<span class="mr-1">Closed</span>
<span class="badge badg-pill badge-success">
{{$appointmentClosed}}
</span>
</button>
</div>
</div>
<div class="col-md-3">
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
</div>
</div>
<div class="card card-success" style="margin-top:5px;">
<div class="card-header">
<h5 class="card-title">
Welcome To The Appointment Section
</h5>
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
<!-- /.card-tools -->
</div>
<!-- /.card-header -->
<div class="card-body">
<table class="table table-striped table-hover table-bordered">
<thead>
<tr>
<th>ID</th>
<th>Client Name</th>
<th>Date</th>
<th>Time</th>
<th>Status</th>
<th colspan="2">Actions</th>
</tr>
</thead>
<tbody>
@foreach($appointments as $appointment)
<tr>
<td>{{$appointment->id}}</td>
<td>
{{$appointment->client->name}}
</td>
<!--To create a format for date and time we create a method
toFormatedDate & toFormattedTime using Carbon class in app.service.provider.php-->
<td>{{$appointment->date->toFormattedDate()}}</td>
<td>{{$appointment->time->toFormattedTime()}}</td>
<td>
@if($appointment->status=='Scheduled')
<span class="badge badge-warning">
SCHEDULED
</span>
@elseif($appointment->status=='Closed')
<span class="badge badge-success">
Closed
</span>
@endif
</td>
<td>
<a href="{{route('editappointment',$appointment)}}">
<span class="fa fa-edit"></span>
</a>
</td>
<td>
<a href="#" wire:click.prevent="confirmdeleteappointment({{$appointment->id}})">
<span class="fa fa-trash"></span>
</a>
</td>
@endforeach
</tr>
</tbody>
</table>
</div>
<div class="card-footer">
{{$appointments->links()}}
</div>
<!-- /.card-body -->
</div>
<!-- /.card -->

<script>
// Confirm delete appointment
window.addEventListener('confirmdeleteappointment', event => {
Swal.fire({
title: 'Are you sure ?',
text: "You won't be able to revert this!",
icon: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
cancelButtonColor: '#d33',
confirmButtonText: 'Delete It'
}).then((result) => {
if (result.isConfirmed) {
Livewire.emit('deleteconfirmed');
}
})
});
</script>
<script>
// If deleted
window.addEventListener('deletedappointment', event => {
Swal.fire(
'Deleted!',
'Your Appointment has been deleted.',
'success'
)
});
</script>
<div wire:loading>
<div style="    position: absolute;
    left: 50%;
    top: 35%;
    display: none;
    background: transparent url("../images/loading-big.gif");
    z-index: 1000;
    height: 31px;
    width: 31px;" class="spinner-border m-5" role="status">
<span class="sr-only">Loading...</span>
</div>
</div>

</div>