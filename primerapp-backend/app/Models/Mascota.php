<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Veterinario;
use App\Models\TipoMascota;

/*
    ? Actividad 3. Arquitectura cliente - servidor (primera parte)
    * Saldaña Espinoza Hector
    * 7B
    ! Elaboración: 25 de septiembre del 2021
*/

class Mascota extends Model{
    use HasFactory;
    protected $table = 'mascotas';

    // ? Para usar Fill se debe usar esto
    protected $fillable = [
        'id',
        'tipo_mascotas_id',
        'raza',
        'tamanio',
    ];

    public $timestamps = false;

    // ? + cuando se haga una consulta a mascota, tambien traiga información de las llaves foraneas
    public function tipoMascota(){ // * Regreso obejto
        return $this->belongsTo(TipoMascota::class, 'tipo_mascotas_id');
    }

    public function veterinarios(){ // * Regresa arreglo
        // ? Devuelva el arreglo de los veterinarios de una mascota
        return $this->belongsToMany(
            Veterinario::class,
            'mascotas_veterinarios', // * NOMBRE DE LA TABLA (PIVOT))
            'mascotas_id', // * Campo mascota de la tabla (DONDE ESTOY)
            'veterinarios_id' // * Campo veterinarios de la misma tabla (DONDE QUIERO IR)
        );

    }

}
