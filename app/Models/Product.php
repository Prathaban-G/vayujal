<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'productname',
        'producttype',
        'contactperson',
        'mobileno',
        'email',
        'address',
        'serialnumber',
        'city',
        'zipcode',
        'state',
        'info',
    ];
}
