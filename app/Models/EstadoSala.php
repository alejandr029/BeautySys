<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoSala extends Model
{
    use HasFactory;
    protected $table = 'locacion.estado_sala';
    protected $primaryKey = 'id_estado_sala';
    public $timestamps = false;

    public function Sala()
    {
        return $this->belongsTo(Sala::class, 'id_sala', 'id_sala');
    }
}
