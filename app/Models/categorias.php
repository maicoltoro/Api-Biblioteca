<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class categorias extends Model
{
    protected $fillable = ['categoria'];

    public function libros()
    {
        return $this->hasMany(Libros::class);
    }
}
