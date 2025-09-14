<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $primaryKey = 'project_id';
    public $incrementing = false; // kalau PK auto increment
    protected $keyType = 'int';  // kalau tipe datanya integer

    protected $fillable = [
        'title',
        'description',
        'image',
        'link',
        'code',
        'skill',
        'status',
        'pinned',
        'slug'
    ];

    protected $casts = [
        'skill' => 'array', // agar json skill bisa otomatis jadi array
        'pinned' => 'boolean',
    ];
}
