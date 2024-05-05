<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estados extends Model
{
    protected $fillable = ['estado']; 
    public function prestamo()
    {
        return 
            $this->belongsTo(prestamos::class);
    }
}
