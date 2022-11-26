<?php

namespace App\Http\Controllers;

use App\Models\Servicios;
use Illuminate\Http\Request;

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
        return response()->json(['datos' => $request]);
    }
}
