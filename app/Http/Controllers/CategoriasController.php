<?php

namespace App\Http\Controllers;

use App\Models\categorias;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoriasController extends Controller
{
   /**
    * Este código PHP define operaciones CRUD para un recurso de "categorías", incluidas funciones de
    * indexación, creación, actualización y destrucción con validación y manejo de errores.
    * 
    * @return El código proporcionado es para un controlador Laravel que maneja operaciones CRUD para
    * un modelo llamado `categorías`. Esto es lo que devuelve cada método:
    */
    public function index()
    {
        $categorias = categorias::all()  ;
        return response()->json($categorias, 200);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'categoria' => 'required|string|max:255',
        ]);

        if($validator -> fails()){
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $libro = categorias::create($request->all());

        return response()->json($libro, 201);
    }


    public function update(Request $request)
    {
        $categoria = categorias::findOrFail($request->id);

        $validator = Validator::make($request->all(), [
            'categoria' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        
        $categoria->update($request->all());
    
        return response()->json($categoria, 200);
    }

    public function destroy(Request $request)
    {
        $id = str_split($request -> id);
        for ($i=0; $i < count($id) ; $i++) { 
            $categoria = categorias::find($id[$i]);
            if($categoria != null){
                $categoria->delete();
            }
        }       
        return response()->json(['message' => "se eliminaron correctamente"], 200);
    }

   
}
