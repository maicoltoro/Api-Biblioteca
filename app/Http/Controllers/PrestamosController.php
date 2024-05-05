<?php

namespace App\Http\Controllers;

use App\Models\Libros;
use App\Models\prestamos;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PrestamosController extends Controller
{
    /**
     * El fragmento de código contiene funciones PHP para gestionar préstamos de libros, incluida la
     * creación, actualización y eliminación de registros de préstamos.
     * 
     * @return La función "índice" devuelve una colección de todos los préstamos con información
     * adicional sobre el libro asociado, el usuario y el estado del préstamo.
     */
    public function index()
    {
        $prestamos = DB::table('prestamos')
            ->leftJoin('Libros', 'prestamos.idlibro', '=', 'libros.id')
            ->leftJoin('users', 'prestamos.idusuario', '=', 'users.id')
            ->leftJoin('estados', 'prestamos.idEstado', '=', 'estados.id')
            ->select('prestamos.*', 'libros.nombre as Nombre_Libro', 'users.name as Usuario','estados.estado as Estado')
            ->get();
        return $prestamos;
    }

    public function create(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'idusuario' => 'required|integer|exists:users,id',
            'idlibro' => 'required|integer|exists:libros,id',
            'idEstado' => 'required|integer|exists:estados,id',
            'tiempo_semanas' => 'required|integer'
        ]);

        if($validator -> fails()){
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $prestamos = prestamos::create($request->all());

        $libro = Libros::findOrFail($prestamos->idlibro);
        $libro->cantidad -= 1;
        $libro->save();
        return response()->json($prestamos, 201);
    }

    public function update(Request $request)
    {
        $prestamos = prestamos::findOrFail($request->id);

        $validator = Validator::make($request->all(), [
            'idusuario' => 'required|integer|exists:users,id',
            'idlibro' => 'required|integer|exists:libros,id',
            'idEstado' => 'required|integer|exists:estados,id',
            'tiempo_semanas' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        
        $prestamos->update($request->all());
    
        return response()->json($prestamos, 200);
    }

    public function destroy(Request $request)
    {
        $id = str_split($request -> id);
        for ($i=0; $i < count($id) ; $i++) { 
            $prestamos = prestamos::find($id[$i]);
            if($prestamos != null){
                $prestamos->delete();
            }
        }       
        return response()->json(['message' => "se eliminaron correctamente"], 200);
    }
}
