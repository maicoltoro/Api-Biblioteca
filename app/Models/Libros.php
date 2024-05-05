<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Libros extends Model
{

    protected $fillable = ['nombre', 'cantidad', 'idcategoria'];

    public function categoria()
    {
        return 
            $this->belongsTo(categorias::class);
    }

    public function prestamo()
    {
        return 
        $this->belongsTo(prestamos::class);
    }
}
