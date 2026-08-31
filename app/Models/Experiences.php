<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Experiences extends Model
{
    protected $fillable = [
        'company_name',
        'position',
        'start_date',
        'end_date',
        'location',
        'description',
        'company_logo',
    ];
}
