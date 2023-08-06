<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $table = 'locacion.area';
    protected $primaryKey = 'id_area';
    use HasFactory;
}
