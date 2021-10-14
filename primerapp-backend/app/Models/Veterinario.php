<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Mascota;

class Veterinario extends Model
{
    use HasFactory;
    protected $table = "veterinarios";
    protected $fillable=[
        "nombre",
        "apellido1",
        "apellido2",
        "cedula_profesional"
    ];
    
    public function mascotas(){ // * Regresa arreglo
        // ? Devuelva el arreglo de los veterinarios de una mascota
        return $this->belongsToMany(
            Mascota::class,
            'mascotas_veterinarios', // * NOMBRE DE LA TABLA (PIVOT))
            'veterinarios_id', // * Campo mascota de la tabla (DONDE ESTOY)
            'mascotas_id' // * Campo veterinarios de la misma tabla (DONDE QUIERO IR)
        );
        
    }

    public $timestamps = false;
}
