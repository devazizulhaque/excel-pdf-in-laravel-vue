<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'employee_name',
        'month',
        'date',
        'day',
        'department',
        'first_in_time',
        'last_out_time',
        'hours_of_work'
    ];
}
