<?php

namespace App\Http\Controllers;

use App\Models\Citas;
use App\Models\CitasServicios;
use App\Models\Servicios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    //
    public function servicios()
    {
        $servicios = Servicios::all();
        return response()->json($servicios);
    }

    public function crearCita(Request $request)
    {
        $fecha = $request->fecha;
        $hora = $request->hora;
        $usuario_id = $request->usuario_id;
        $servicios_string = $request->servicios;
        $servicios = explode(',', $servicios_string);


        try {
            DB::beginTransaction();

            // Crea la cita y la guarda en una variable
            $cita = Citas::create([
                'fecha' => $fecha,
                'hora' => $hora,
                'usuario_id' => $usuario_id
            ]);

            // Por cada servicio, guarda un registro en citas_servicios
            foreach($servicios as $servicio) {
                $cita_servicio = CitasServicios::create([
                    'cita_id' => $cita->cita_id,
                    'servicio_id' => $servicio,
                ]);
            }

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack($e);
        }

        return response()->json('Cita generada con exito!');
        // return response()->json($servicios);
    }
}
