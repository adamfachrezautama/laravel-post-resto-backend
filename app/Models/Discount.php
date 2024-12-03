<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

    protected $filable = [
        'name',
        'description',
        'type',
        'value',
        'status',
        'expired_date',
    ];
}
