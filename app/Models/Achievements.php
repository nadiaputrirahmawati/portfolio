<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Achievements extends Model
{
    protected $primaryKey = 'achievements_id';
    public $incrementing = true; // kalau PK auto increment
    protected $keyType = 'int';  // kalau tipe datanya integer

    protected $fillable = [
        'title',
        'credentials',
        'image',
        'link',
        'status',
    ];
}
