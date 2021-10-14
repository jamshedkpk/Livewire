<div class="container">
<div class="row">
<div class="col-md-12">
<br>
<a href="{{route('createappointment')}}">
<button class="btn btn-success btn-sm float-right">
<span class="fa fa-plus-circle mr-2"></span>
Add New Appointment
</button>
</a>
</div>
</div>
<br>
<div class="card card-success">
<div class="card-header">
<h3 class="card-title">
Welcome To The Appointment Section
</h3>
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
</tr></thead>
<tbody>
@foreach($appointments as $appointment)
<tr>
<td>{{$appointment->id}}</td>
<td>{{$appointment->client->name}}</td>
<td>{{$appointment->date}}</td>
<td>{{$appointment->time}}</td>
<td>{{$appointment->status}}</td>
<td>
<a href="#">
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
window.addEventListener('confirmdeleteappointment',event=>{
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
window.addEventListener('deletedappointment',event=>{
    Swal.fire(
      'Deleted!',
      'Your Appointment has been deleted.',
      'success'
    )
});
</script>
</div>