<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class prestamos extends Model
{
    protected $fillable = ['idusuario', 'idlibro', 'tiempo_semanas','idEstado'];

    public function libro()
    {
        return 
            $this->hasMany(Libros::class);
    }

    public function usuario (){
        return $this->hasMany(User::class);
    }

    public function estado (){
        return $this->hasMany(estados::class);
    }
}
