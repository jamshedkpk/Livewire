<div class="container">
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
            <form id="formappointment" wire:submit.prevent="addappointment">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Client</label>
                            <select id="client_id" class="form-control" wire:model.defer="state.client_id">
                                <option>Select A Client Name</option>
                                @foreach($clients as $client)
                                <option value="{{$client->id}}">
                                    {{$client->name}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Date</label>
                            <input id="date" wire:model.defer="state.date" type="date" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Time</label>
                            <input id="time" wire:model.defer="state.time" type="time" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <input id="note" wire:model.defer="state.note" type="textarea" class="form-control" placeholder="Notes can be written here.....">
                    </div>
                    <div class="col-md-4">
                        <button class="btn btn-success btn-block">
                            <span class="fa fa-plus-circle"></span>
                            Book Appoitment
                        </button>
            </form>
        </div>
    </div>
</div>
<!-- /.card-body -->
</div>
<!-- /.card -->
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
        $('#formappointment').reset();
    })
</script>
</div>