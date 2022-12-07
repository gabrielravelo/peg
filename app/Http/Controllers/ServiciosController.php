<?php

namespace App\Http\Controllers;

use App\Models\Servicios;
use Illuminate\Http\Request;
use App\Models\CitasServicios;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ServiciosController extends Controller
{
    public function servicios()
    {
        $usuario = Auth::user();
        $servicios = Servicios::all();

        return view('servicios.index', compact('usuario', 'servicios'));
    }

    public function formularioCrearServicio()
    {
        $usuario = Auth::user();

        return view('servicios.create', compact('usuario'));
    }

    public function crearServicio(Request $request)
    {
        $request->validate([
            'nombre' => ['required', 'string', 'min:5', 'max:30'],
            'precio' => ['required', 'integer', 'min:1', 'max:999'],
        ]);

        DB::beginTransaction();
        try {
            // Se crea el servicio
            Servicios::create([
                'nombre' => $request->nombre,
                'precio' => $request->precio
            ]);

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }

        return redirect()->route('servicios')->with('agregar', 'ok');
    }

    public function formularioEditarServicio($servicio_id)
    {
        $usuario = Auth::user();
        $servicio = Servicios::find($servicio_id);

        return view('servicios.edit', compact('usuario', 'servicio'));
    }

    public function editarservicios($servicio_id, Request $request)
    {
        $request->validate([
            'nombre' => ['required', 'string', 'min:5', 'max:30'],
            'precio' => ['required', 'min:1', 'max:999'],
        ]);
        $servicio = Servicios::find($servicio_id);

        DB::beginTransaction();
        try {
            // Se actualiza el servicio
            $servicio->update([
                'nombre' => $request->nombre,
                'precio' => $request->precio
            ]);

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }

        return redirect()->route('servicios')->with('actualizar', 'ok');
    }

    public function eliminarServicio($servicio_id)
    {
        $servicio = Servicios::find($servicio_id);
        $servicios_cita = CitasServicios::where('servicio_id', $servicio_id)->get();

        DB::beginTransaction();
        try {
            // Eliminar los servicios en citas_servicios
            foreach($servicios_cita as $servicio) {
                $servicio->delete();
            }

            // Eliminar la cita
            $servicio->delete();

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollback();
            return $e;
        }

        return redirect()->route('servicios')->with('eliminar', 'ok');
    }
}
