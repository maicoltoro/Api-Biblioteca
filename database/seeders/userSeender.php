<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class userSeender extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users') ->insert([
            'name' => "maicol",
            'email' => "maicol@gmail.com",
            'idRol' => 1,
            'password' => "maicol123",
        ]);
    }
}
