<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    protected $table = 'estetico.consulta';
    protected $primaryKey = 'id_consulta';
    use HasFactory;
}
