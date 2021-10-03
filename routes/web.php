<?php
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\User\IndexUser;
use App\Http\Controllers\DashboardController;

Route::get('admin/user',IndexUser::class)->name('user');
Route::get('admin/dashboard',[DashboardController::class,'index'])->name('dashboard');

Route::get('/', function () {
    return view('welcome');
});
