<?php

namespace App\Http\Controllers;

use App\Models\Roles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RolesController extends Controller
{
   /**
    * El fragmento de código muestra funciones PHP para recuperar todos los roles y crear un nuevo rol
    * con validación.
    * 
    * @return La función `index` devuelve una respuesta JSON con todos los roles recuperados de la base
    * de datos, mientras que la función `create` valida los datos de la solicitud entrante, crea un
    * nuevo registro de rol en la base de datos y devuelve una respuesta JSON con los datos del rol
    * creado.
    */
    public function index()
    {
        $rol = Roles::all();
        return response()->json($rol, 200);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'rol' => 'required|string'            
        ]);

        if($validator -> fails()){
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $rol = Roles::create($request->all());
        return response()->json($rol, 201);
    }
}
