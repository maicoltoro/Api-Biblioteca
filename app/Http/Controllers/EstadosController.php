<?php

namespace App\Http\Controllers;

use App\Models\Estados;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EstadosController extends Controller
{
  /**
   * El fragmento de código muestra funciones PHP para recuperar todos los estados y crear un nuevo
   * estado con validación.
   * 
   * @return En la función `index`, se devuelve una respuesta JSON que contiene todos los registros de
   * Estado obtenidos de la base de datos con un código de estado de 200.
   */
    public function index()
    {
        $estado = Estados::all();
        return response()->json($estado, 200);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'estado' => 'required|string'            
        ]);

        if($validator -> fails()){
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $estado = Estados::create($request->all());
        return response()->json($estado, 201);
    }
}
