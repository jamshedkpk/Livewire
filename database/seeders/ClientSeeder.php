<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Client;

class ClientSeeder extends Seeder
{
public function run()
{
Client::Create
([
'name'=>'Jamshed Khan',
]);
Client::Create
([
'name'=>'Samreena',
]);
Client::Create
([
'name'=>'Irtaza',
]);
Client::Create
([
'name'=>'Junaid',
]);
Client::Create
([
'name'=>'Salman',
]);
}
}
