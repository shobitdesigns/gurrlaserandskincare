<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Appointment extends Model
{
    use HasFactory;

    protected $guarded  =   ['id'];
    protected $table    =   'appointments';

    public function getTimeAttribute()
    {
        return Carbon::parse($this->attributes['time'])->format('g:i A');
    }
}
