<?php
namespace Database\Factories;
use App\Models\Appointment;
use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class AppointmentFactory extends Factory
{
protected $model = Appointment::class;
public function definition()
{
$id=Client::pluck('id')->toArray();
return 
[
'client_id'=>$this->faker->randomElement($id),
'date'=>$this->faker->date(),
'time'=>$this->faker->time(),
'status'=>$this->faker->randomElement(['Scheduled','Closed']),
'note'=>$this->faker->text(),
];
}
}
