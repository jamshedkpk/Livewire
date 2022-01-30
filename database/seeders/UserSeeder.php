<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class UserSeeder extends Seeder
{
public function run()
{
User::create
([
'name'=>'Kamran',
'email'=>'Kamran@gmail.com',
'photo'=>'Image-1.jpeg',
'password'=>Hash::make('admin555'),
'role'=>'admin',
]);
User::create
([
'name'=>'Salma',
'email'=>'Salma@gmail.com',
'photo'=>'Image-2.jpeg',
'password'=>Hash::make('admin555'),
'role'=>'user',
]);
User::create
([
'name'=>'Tahir',
'email'=>'Tahir@gmail.com',
'photo'=>'Image-3.jpeg',
'password'=>Hash::make('admin555'),
'role'=>'client',
]);
User::create
([
'name'=>'Hameed',
'email'=>'Hameed@gmail.com',
'photo'=>'Image-4.jpeg',
'password'=>Hash::make('admin555'),
'role'=>'admin',
]);
User::create
([
'name'=>'Naila',
'email'=>'Naila@gmail.com',
'photo'=>'Image-5.jpeg',
'password'=>Hash::make('admin555'),
'role'=>'user',
]);
}
}
