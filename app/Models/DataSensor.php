<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataSensor extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = ['device_id','temperature', 'humidity', 'light_intensity'];
}
