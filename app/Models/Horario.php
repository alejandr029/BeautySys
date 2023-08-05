<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    protected $table = 'personal.horario';
    protected $primaryKey = 'id_horario';
    use HasFactory;
}
