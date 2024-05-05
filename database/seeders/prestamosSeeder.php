<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class prestamosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('prestamos') ->insert([
            'idusuario' => 1,
            'idlibro' => 1,
            'idestado' => 2,
            'tiempo_semanas' => 2,
        ]);
        DB::table('prestamos') ->insert([
            'idusuario' => 1,
            'idlibro' => 2,
            'idestado' => 2,
            'tiempo_semanas' => 2,
        ]);
    }
}
