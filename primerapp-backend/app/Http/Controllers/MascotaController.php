<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use App\Models\Mascota;

/*
    ? Actividad 3. Arquitectura cliente - servidor (primera parte)
    * Saldaña Espinoza Hector
    * 7B
    ! Elaboración: 25 de septiembre del 2021
*/

class MascotaController extends Controller
{
    // ? GET -> Recuperar las mascotas
    public function showAll(Request $request)
    {
        $respuesta = ['mensaje' => '', 'error' => true, 'estado' => 500, 'mascotas' => [],];
        try {
            // * Segundo método all()
            $respuesta['mascotas'] = Mascota::all();
            $respuesta['mensaje'] = "Consulta exitosa";
            $respuesta['error'] = false;
            $respuesta['estado'] = 200;
        } catch (\Exception $th) {
            $respuesta['mensaje'] = $th;
        } finally {
            return response()->json($respuesta, $respuesta['estado']);
        }
    }

    // ? POST -> Crear o actualizar una mascota
    public function store(Request $request)
    {
        $respuesta = ['mensaje' => '', 'error' => true, 'estado' => 500, 'mascota' => [],];
        try {
            DB::beginTransaction();
            // * Primero método fill(array)
            $objetoMascota = new Mascota();
            $objetoMascota->fill(['raza' => $request->raza, 'tamanio' => $request->tamanio, 'tipo_mascotas_id' => $request->tipo_mascotas_id]);
            $objetoMascota->save();
            $respuesta['mensaje'] = 'Se creó correctamente la mascota';
            $respuesta['estado'] = 201;
            $respuesta['error'] = false;
            $respuesta['mascota'] = $objetoMascota;
            DB::commit();
        } catch (QueryException $queryException) {
            $respuesta['mensaje'] = $queryException;
            DB::rollBack();
        } finally {
            return response()->json($respuesta, $respuesta['estado']);
        }
    }

    public function update(Request $request)
    {
        $respuesta = ['mensaje' => '', 'error' => true, 'estado' => 500, 'mascota' => [],];
        try {
            // * Cuarto método query()->where()->update()
            DB::beginTransaction();
            $objetoMascota = Mascota::query()
                ->where('id', $request->id)
                ->update(['raza' => $request->raza, 'tamanio' => $request->tamanio, 'tipo_mascotas_id' => $request->tipo_mascotas_id]);
            $respuesta['mensaje'] = 'Se actualizó correctamente la mascota';
            $respuesta['estado'] = 200;
            $respuesta['mascota'] = $objetoMascota;
            DB::commit();
        } catch (QueryException $queryException) {
            $respuesta['mensaje'] = $queryException;
            DB::rollBack();
        } finally {
            return response()->json($respuesta, $respuesta['estado']);
        }
    }

    public function listarMascotas(Request $request)
    {
        $listasMascota = DB::select('select * from mascotas where raza = ?', [$request->raza]);
        $message = ($listasMascota) ? "Consulta existosa" : "Sin registros";
        return response()->json(['error' => false, 'message' => $message, "lista" => $listasMascota], 200);
    }

    public function show($id)
    {
        // ? + Nos retorna el registro con la información de la llave foránea (como un JOIN)
        $objetoMascota = Mascota::with('tipoMascota')->where('id', $id)->first();
        return response()->json(['error' => false, 'message' => "Consulta existosa", "registro" => $objetoMascota], 200);
    }

    public function destroy($id)
    {
        $objetoMascota = Mascota::find($id);
        if ($objetoMascota) {
            $objetoMascota->delete();
            return response()->json(["error" => false, "message" => "Eliminación exitosa."], 200);
        } else {
            return response()->json(["error" => false, "message" => "Registro inexistente."], 200);
        }

    }

    public function testCollections(Request $request)
    {
        $respuesta = ['estado' => 500, 'mascotas' => []];
        try {
            // * Tercer método filter()
            $mascotas = Mascota::all();
            $filtro = $mascotas->filter(function ($mascota) {
                return $mascota->tamanio == "Grande";
            })->all();
            $respuesta['estado'] = 200;
            $respuesta['mascotas'] = $filtro;
        } catch (\Exception $th) {
            $respuesta['mensaje'] = $th;
        } finally {
            return response()->json($respuesta, $respuesta['estado']);
        }
    }


    public function pruebasConsulta(Request $request)
    {
        // $listarMascota = DB::select('select * ...')
        // $listarMascota = Mascota::find($id)
        // $lista = Mascota::where('raza', $request -> raza)->get();
        // $lista = Mascota::where('raza', $request -> raza)->orderBy('id', 'desc')->first(); // ? Lo trae de forma ascendente
        /*  if($request -> raza){
             $lista = DB::table('mascotas')->where('raza','boxer')->orWhere(funcion($query){
                 $query -> where('raza', 'salchcia');
                 $query -> orWhere('raza','labrador');
             })->get();
             // $lista = Mascota::where('raza', $request -> raza)->orderBy('id')->take(3)->get(); // ? Lo trae de forma ascendente
         }else{
             $l ista = Mascota::all();
         }*/
        /*
        $query = "SELECT * FROM mascotas";
        $arrayId = explode(",", $request->ids);
        $i=0;
        foreach($arrayId as $item){
            if($i == 0){
                $query = "$query WHERE id = $item";
                $i++;
            }else{
                $query = "$query OR id = $item";
            }
        }


        $lista = Mascota::where('raza', 'Pug')->get();
        $cantidad = sizeof($lista);
        $cantidadRegistros = Mascota::where('raza', 'Pug')->count();


        // ? Tambien funciona
        // $lista3 = Mascota::whereIn('id', $arrayId)->get();

        /*
        var_dump($query);
        die();

        $query = ($request->raza)?"$query WHERE raza = ?": $query;
         var_dump($query);
        die();
        $lista2 = DB::select($query,[]);

        return response()->json(["lista"=>$lista],200);
        */
    }
}
