<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class libroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('libros') ->insert([
            'nombre' => "Amor en los tiempos de colera",
            'idcategoria' => 2,
            'cantidad' => 12,
        ]);
        DB::table('libros') ->insert([
            'nombre' => "Jaque al psicoanalista",
            'idcategoria' => 1,
            'cantidad' => 15,
        ]);
        DB::table('libros') ->insert([
            'nombre' => "El psicoanalista",
            'idcategoria' => 1,
            'cantidad' => 10,
        ]);
    }
}
