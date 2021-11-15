<div class="container">
<br>
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
<form id="formupdateappointment" wire:submit.prevent="updateappointment">
<div class="row">
<div class="col-md-6">
<div class="form-group">
<label for="">Client</label>
<select id="client_id" class="form-control @error('client_id') is-invalid @enderror " wire:model.defer="state.client_id">
<option>Select A Client Name</option>
@foreach($clients as $client)
<option value="{{$client->id}}">
{{$client->name}}
</option>
@endforeach
</select>
@error('client_id')
<div class="invalid-feedback">
{{$message}}
</div>
@enderror
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label for="">Status</label>
<select wire:model.defer="state.status" class="form-control @error('status') is-invalid @enderror" wire:model.defer="state.client_id">
<option>Select A Status</option>
<option value="Scheduled">Scheduled</option>
<option value="Closed">Closed</option>
</select>
@error('status')
<div class="invalid-feedback">
{{$message}}
</div>
@enderror
</div>
</div>
</div>
<div class="row">
<div class="col-md-6">
<div class="form-group">
<label for="">Date</label>
<input id="date" wire:model.defer="state.date" type="date" class="form-control @error('date') is-invalid @enderror">
</input>
@error('date')
<div class="invalid-feedback">
{{$message}}
</div>
@enderror
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label for="">Time</label>
<input id="time" wire:model.defer="state.time" type="time" class="form-control @error('time') is-invalid @enderror">
@error('time')
<div class="invalid-feedback">
{{$message}}
</div>
@enderror
</div>
</div>
</div>
<div class="row">
<div class="col-md-12">
<div class="form-group" wire:ignore>
<textarea class="form-control" data-note="@this" name="note" wire:model.defer="state.note" id="note" cols="30" rows="10">
{!! $state['note'] !!}    
</textarea>
</div>
</div>
</div>
<br>
<div class="row">
<div class="col-md-6">
<button type="submit" id="submit" class="btn btn-success btn-block">
<span class="fa fa-edit"></span>
Update Appointment
</button>
</div>

<div class="col-md-6">
<a href="{{route('appointment')}}" class="btn btn-success btn-block">
<span class="fa fa-home"></span>
Homepage
</a>
</div>
</div>

</div>
</div>
</form>

<script>
// Appointment added successfully sweat alert box
window.addEventListener('appointmentadded', event => {
Swal.fire({
position: 'top-center',
icon: 'success',
iconColor: 'green',
title: 'Appointment is successfully booked',
timerProgressBar: true,
showConfirmButton: false,
timer: 2000
});
$('#saveappointment').clik(function() {});
})
</script>

<script src="https://cdn.ckeditor.com/ckeditor5/30.0.0/classic/ckeditor.js"></script>
<script>
// CK Editor setting
ClassicEditor
.create(document.querySelector('#note'))
.then(editor => {
document.querySelector('#submit').addEventListener('click', event => {
let note = $('#note').data('note');
eval(note).set('state.note', editor.getData());
});
})
.catch(error => {
console.error(error);
});
</script>
<script>
window.addEventListener('appointmentupdated',event=>{
Swal.fire({
  position: 'top-center',
  icon: 'success',
  iconColor:'limegreen',
  title: 'Your appointment has been Updated',
  showConfirmButton: false,
  timer: 1500
});
});
</script>
</div>