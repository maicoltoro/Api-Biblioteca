<?php

namespace App\Http\Controllers;

use App\Models\categorias;
use App\Models\Libros;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class LibrosController extends Controller
{
    /**
     * El fragmento de código contiene funciones PHP para administrar libros y categorías en una base
     * de datos, incluidas operaciones CRUD y búsqueda de categorías.
     * 
     * @return El método `index` devuelve una colección de libros con sus nombres de categoría
     * correspondientes. El método "crear" crea un nuevo registro de libro basado en los datos de la
     * solicitud y devuelve el libro creado con un código de estado de 201. El método "actualizar"
     * actualiza un registro de libro existente basándose en los datos de la solicitud y devuelve el
     * libro actualizado con un estado. código de 200. El método `destroy` elimina varios libros
     */
    public function index()
    {
        $libros = DB::table('libros')
            ->leftJoin('categorias', 'libros.idcategoria', '=', 'categorias.id')
            ->select('libros.*', 'categorias.categoria as nombre_categoria')
            ->get();
        return $libros;
    }

    public function create(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'cantidad' => 'required|integer',
            'idcategoria' => 'required|integer|exists:categorias,id'
        ]);

        if($validator -> fails()){
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $libro = libros::create($request->all());

        return response()->json($libro, 201);
    }

    public function update(Request $request)
    {
        $libro = Libros::findOrFail($request->id);

        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'cantidad' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        
        $libro->update($request->all());
    
        return response()->json($libro, 200);
    }

    public function destroy(Request $request)
    {
        $id = str_split($request -> id);
        for ($i=0; $i < count($id) ; $i++) { 
            $libro = Libros::find($id[$i]);
            if($libro != null){
                $libro->delete();
            }
        }       
        return response()->json(['message' => "se eliminaron correctamente"], 200);
    }

    public function Categorias()
    {
        $categorias = categorias::all()  ;
        return response()->json($categorias, 200);
    }
}
