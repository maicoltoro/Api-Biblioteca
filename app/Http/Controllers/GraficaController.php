<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GraficaController extends Controller
{
   /**
    * The functions retrieve data for generating graphs showing the number of books borrowed by each
    * user and the number of times each book has been borrowed.
    * 
    * @return The `GraficaUsuario` function is returning the count of loans per user along with the
    * user's name, while the `GraficaLibros` function is returning the count of loans per book along
    * with the book's name.
    */
    public function GraficaUsuario()
    {
        $libros = DB::table('prestamos')
        ->leftJoin('users', 'prestamos.idusuario', '=', 'users.id')
        ->select(DB::raw('count(prestamos.idusuario) as cantidad'), 'users.name as Usuario')
        ->groupBy('prestamos.idusuario', 'users.name') 
        ->get();
        return $libros;
    }

    public function GraficaLibros()
    {
        $libros = DB::table('prestamos')
        ->leftJoin('libros', 'prestamos.idlibro', '=', 'libros.id')
        ->select(DB::raw('count(prestamos.idlibro) as cantidad'), 'libros.nombre as Libro')
        ->groupBy('prestamos.idlibro', 'libros.nombre') 
        ->get();
        return $libros;
    }
}
