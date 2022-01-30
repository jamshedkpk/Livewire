<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Appointment;

class AppointmentSeeder extends Seeder
{
public function run()
{
Appointment::create
([
'client_id'=>'1',
'date'=>'20-10-2020',
'time'=>'04:30',
'status'=>'Active',
'note'=>'Working',
]);
Appointment::create
([
'client_id'=>'2',
'date'=>'20-10-2021',
'time'=>'05:30',
'status'=>'Pending',
'note'=>'Not Working',
]);
Appointment::create
([
'client_id'=>'3',
'date'=>'20-10-2022',
'time'=>'06:30',
'status'=>'Completed',
'note'=>'Completed',
]);
Appointment::create
([
'client_id'=>'4',
'date'=>'20-02-2020',
'time'=>'04:00',
'status'=>'Active',
'note'=>'Working',
]);
Appointment::create
([
'client_id'=>'5',
'date'=>'20-10-2020',
'time'=>'04:00',
'status'=>'Active',
'note'=>'Working',
]);
}
}
