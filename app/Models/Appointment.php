<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Client;
use Livewire\WithPagination;

class Appointment extends Model
{
use HasFactory;
protected $fillable=['client_id','date','time','status','note'];
protected $dates = ['date','time'];

public function client()
{
return $this->belongsTo(Client::class);    
}
}