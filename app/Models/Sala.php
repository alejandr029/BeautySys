<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sala extends Model
{
    use HasFactory;
    protected $table = 'locacion.sala';
    protected $primaryKey = 'id_sala';
    public $timestamps = false;
    protected $fillable = [
        'nombre',
        'capacidad',
        'id_area',
    ];

    public function estadoSala()
    {
        return $this->belongsTo(EstadoSala::class, 'id_estado_sala', 'id_estado_sala');
    }
}
