<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnfermedadCronica extends Model
{
    protected $table = 'usuario.enfermedad_cronica';
    protected $primaryKey = 'id_enfermedad_cronica';
    use HasFactory;
}
