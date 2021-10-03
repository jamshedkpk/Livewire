<?php
namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class BladeComponentServiceProivder extends ServiceProvider
{
public function register()
{
Blade::component('layouts.app','admin-layout');
}
public function boot()
{
}
}
