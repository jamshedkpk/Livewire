<?php
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\User\IndexUser;
use App\Http\Controllers\DashboardController;
use App\Http\Livewire\Appointment\IndexAppointment;
use App\Http\Livewire\Appointment\CreateAppointment;
use GuzzleHttp\Promise\Create;

Route::get('/',[DashboardController::class,'index'])->name('dashboard');
Route::get('admin/user',IndexUser::class)->name('user');
Route::get('admin/appointment',IndexAppointment::class)->name('appointment');
Route::get('admin/appointment/create',CreateAppointment::class)->name('createappointment');

// Route::get('/', function () {
//     return view('welcome');
// });
