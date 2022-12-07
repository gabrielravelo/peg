<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CitasServicios extends Model
{
    use HasFactory;

    protected $table = 'citas_servicios';
    protected $primaryKey = 'cita_servicio_id';

    protected $fillable = [
        'cita_id',
        'servicio_id',
    ];
}
