<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $primaryKey = 'project_id'; // jika kamu pakai project_id sebagai primary key
    protected $guarded = []; // artinya semua kolom boleh diisi (tidak ada yang dikunci)
}
