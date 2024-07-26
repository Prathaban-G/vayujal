<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
   
    protected $table = 'data';

    protected $fillable = [
        'hw_id', 'datetime', 'temperature', 'humidity', 'waterlevel', 'waterflow', 'airflow',
        'pressure_lowswitch', 'pressurehighswitch', 'pressureoutswitch', 'tds', 'voltager', 'voltagey', 'voltageb',
        'currentr', 'currenty', 'currentb', 'avgvoltage', 'avgcurrent', 'frequency', 'kwh', 'fan', 'compressor',
        'dispensor', 'ozonizer', 'buzzer', 'external', 'power_status', 'battery_per', 'humiditybg', 'temperaturebg',
        'waterlevelbg', 'airflowbg', 'pressurebg', 'tdsbg', 'fanbg', 'compressorbg', 'dispensorbg'
    ];
}
