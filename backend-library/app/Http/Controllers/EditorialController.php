<?php

namespace App\Http\Controllers;

use App\Models\Editorial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EditorialController extends Controller
{

    // ? Mostrar todos
    public function index()
    {
        $response = ['message' => 'Ocurrió un error', 'error' => true, 'code' => 500, 'data' => []];
        try {
            $response['data'] = Editorial::all();
            $response['message'] = 'Búsqueda exitosa';
            $response['error'] = false;
            $response['code'] = 200;
        } catch (Exception $e) {
        } finally {
            return response()->json($response, $response['code']);
        }
    }

    // ? Crear uno
    public function store(Request $request)
    {
        $response = ['message' => 'Ocurrió un error', 'error' => true, 'code' => 500, 'data' => []];
        try {
            DB::beginTransaction();
            if (!$request->id) {
                $obj = new Editorial();
                $response['message'] = 'Creación exitosa';
            } else {
                $obj = Editorial::find($request->id);
                $response['message'] = 'Modificación exitosa';
            }
            $obj->fill(['name' => $request->name]);
            $obj->save();
            $response['data'] = $obj;
            $response['error'] = false;
            $response['code'] = 201;
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        } finally {
            return response()->json($response, $response['code']);
        }
    }

    // ? Mostrar uno
    public function show($id)
    {
        $response = ['message' => 'Ocurrió un error', 'error' => true, 'code' => 500, 'data' => []];
        try {
            $obj = Editorial::find($id);
            if($obj){
                $response['message'] = 'Búsqueda exitosa';
            }else{
                $response['message'] = 'No se encontrarón coincidencias';
            }
            $response['data'] = $obj;
            $response['error'] = false;
            $response['code'] = 200;
        } catch (Exception $e) {
        } finally {
            return response()->json($response, $response['code']);
        }
    }

    // ? Eliminar uno
    public function destroy($id)
    {
        $response = ['message' => 'Ocurrió un error', 'error' => true, 'code' => 500, 'data' => []];
        try {
            $obj = Editorial::find($id);
            if($obj){
                $obj->delete();
                $response['message'] = 'Eliminación exitosa';
            }else{
                $response['message'] = 'No se encontrarón coincidencias';
            }
            $response['data'] = $obj;
            $response['error'] = false;
            $response['code'] = 200;
        } catch (Exception $e) {
        } finally {
            return response()->json($response, $response['code']);
        }
    }
}
