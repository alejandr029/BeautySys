<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cirugia extends Model
{
    protected $table = 'estetico.Cirugia';
    protected $primaryKey = 'id_cirugia';
    use HasFactory;
}
