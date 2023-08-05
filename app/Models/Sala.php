<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sala extends Model
{
    protected $table = 'locacion.sala';
    protected $primaryKey = 'id_sala';
    use HasFactory;
}
