<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Especialidad extends Model
{
    protected $table = 'personal.tipo_especialidad';
    protected $primaryKey = 'id_tipo_especialidad';
    use HasFactory;
}
