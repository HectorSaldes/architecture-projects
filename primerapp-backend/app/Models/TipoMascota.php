<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoMascota extends Model
{
    use HasFactory;

    protected $table ="tipo_mascotas";

    protected $fillable =[
        'id',
        'nombre',
        'esta_activo'
    ];

    public $timestamps=false;
    
    protected $cast = [
        'esta_activo' => 'boolean'
    ];
}
