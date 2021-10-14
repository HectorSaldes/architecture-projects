<?php

namespace App\Http\Controllers;

use App\Models\Mascota;
use App\Models\Veterinario;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class VeterinarioController extends Controller
{
    //  ? Ver mascotas de veterinario
    public function show($id){

        $objetoMascota = Mascota::with('veterinarios', 'tipoMascota')->where('id', $id)->first();
        return response()->json(['objeto'=>$objetoMascota],200);
       /*  $objetoMascota = Mascota::find($id);
        foreach($objetoMascota->veterinarios as $item){
            var_dump($item);
        }
        die(); */
    }

    // ? Consultar veterinario
    public function consultarVeterinario($id){
        $objetoVeterinario = Veterinario::with('mascotas')->where('id', $id)->first();
        return response()->json(['objeto'=>$objetoVeterinario],200);
    }

    // ? Guardar o registrar un veterinario con varias mascotas
    public function store(Request $request){
        DB::beginTransaction();
        try {
            if(!$request->id){
                $objetoVeterinario = new Veterinario();
            }else{
                $objetoVeterinario = Veterinario::find($request->id);
                foreach ($objetoVeterinario->mascotas as $item){
                    $objetoVeterinario->mascotas()->detach($item->id); // ? Elimina registros N:M
                }
            }
            $objetoVeterinario->nombre = $request->nombre;
            $objetoVeterinario->apellido1 = $request->apellido1;
            $objetoVeterinario->apellido2 = $request->apellido2;
            $objetoVeterinario->cedula_profesional = $request->cedula_profesional;
            $objetoVeterinario->save();
            foreach ($request->mascotas as $item){
                $objetoVeterinario->mascotas()->attach($item); // * attach guardar de muchos a muchos a través de nuestra función mascota
            }
            DB::commit();
            return response()->json(['error'=>false,'message'=>'Registro exitoso'],200);
        } catch (QueryException $th) {
            DB::rollback();
            return response()->json(['error'=>true,'message'=>$th],200);
        }
    }
}
