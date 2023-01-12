<?php

namespace App\Models;

use App\Models\Citas;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Servicios extends Model
{
    use HasFactory;

    protected $table = 'servicios';
    protected $primaryKey = 'servicio_id';

    protected $fillable = [
        'nombre',
        'precio'
    ];

    public function citasServicios()
    {
        $this->belongsToMany(Citas::class, 'citas_servicios', 'servicio_id', 'cita_id');
    }
}
