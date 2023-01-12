<?php

namespace App\Http\Controllers;

use App\Models\Citas;
use App\Models\Servicios;
use Illuminate\Http\Request;
use App\Models\CitasServicios;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // datos del usuario
        $usuario = Auth::user();
        $fecha = $_GET['fecha'] ?? date('Y-m-d');
        $fechas = explode('-', $fecha);
        if( !checkdate($fechas[1], $fechas[2], $fechas[0]) ) {
            return 'no existe la fecha introducida';
        }

        $citas = Citas::join('users', 'citas.usuario_id', '=', 'users.usuario_id')
        ->join('citas_servicios', 'citas_servicios.cita_id', '=', 'citas.cita_id')
        ->join('servicios', 'servicios.servicio_id', '=', 'citas_servicios.servicio_id')
        ->select('citas.cita_id', 'citas.hora', 'users.nombre as nombre_cliente', 'users.apellido', 'users.email', 'users.telefono', 'servicios.nombre as nombre_servicio', 'servicios.precio')
        ->where('fecha', $fecha)
        ->get();

        return view('/home', compact('usuario', 'citas', 'fecha'));
    }

    public function eliminarCita($cita_id)
    {
        $cita = Citas::find($cita_id);
        $servicios_cita = CitasServicios::where('cita_id', $cita_id)->get();

        DB::beginTransaction();
        try {
            // Eliminar los servicios en citas_servicios
            foreach($servicios_cita as $servicio) {
                $servicio->delete();
            }

            // Eliminar la cita
            $cita->delete();

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollback();
            return $e;
        }

        return redirect()->route('home')->with('eliminar', 'ok');
    }

    public function citas()
    {
        // datos del usuario
        $usuario = Auth::user();
        $citas = Citas::where('usuario_id', $usuario->usuario_id)->get();

        return view('citas', compact('usuario', 'citas'));
    }

    public function eliminarCitaUsuario($cita_id)
    {
        $cita = Citas::find($cita_id);
        $servicios_cita = CitasServicios::where('cita_id', $cita_id)->get();

        DB::beginTransaction();
        try {
            // Eliminar los servicios en citas_servicios
            foreach($servicios_cita as $servicio) {
                $servicio->delete();
            }

            // Eliminar la cita
            $cita->delete();

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollback();

        }

        return redirect()->route('citas')->with('eliminar', 'ok');
    }
}
