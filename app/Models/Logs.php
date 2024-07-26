<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logs extends Model
{
    protected $table = 'logs';

    public function threshold()
    {
        return $this->belongsTo(Threshold::class, 'hw_id', 'hw_id');
    }

    public function data()
    {
        return $this->belongsTo(Data::class, 'hw_id', 'hw_id');
    }
}
