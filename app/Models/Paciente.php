<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;
    public $timestamps = false;
    // EN CADA MODELO QUE SE HAGA DEBE DEFINIRSE SU TABLA Y SU LLAVE PRIMARIA
    protected $table = 'usuario.paciente';
    protected $primaryKey = 'id_paciente';

    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_cuenta');
    }
}
