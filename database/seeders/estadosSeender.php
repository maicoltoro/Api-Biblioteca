<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class estadosSeender extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('estados') ->insert([
            'estado' => "disponible",
        ]);
        
        DB::table('estados') ->insert([
            'estado' => "prestado",
        ]);
    }
}
