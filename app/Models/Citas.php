<?php

namespace App\Models;

use App\Models\Servicios;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Citas extends Model
{
    use HasFactory;

    protected $table = 'citas';
    protected $primaryKey = 'cita_id';

    protected $fillable = [
        'fecha',
        'hora',
        'usuario_id'
    ];

    public function citasServicios()
    {
        return $this->belongsToMany(Servicios::class, 'citas_servicios', 'cita_id', 'servicio_id');
    }
}
