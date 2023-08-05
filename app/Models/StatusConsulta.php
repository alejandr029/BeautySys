<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusConsulta extends Model
{
    protected $table = 'estetico.status_consulta';
    protected $primaryKey = 'id_status_consulta';
    use HasFactory;
}
