<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;

class AuthorController extends Controller
{

    public function index()
    {
        $response = ['message' => 'Ocurrió un error', 'error' => true, 'code' => 500, 'data' => []];
        try {
            $response['data'] = Author::all();
            $response['message'] = 'Búsqueda exitosa';
            $response['error'] = false;
            $response['code'] = 200;
        } catch (Exception $e) {
        } finally {
            return response()->json($response, $response['code']);
        }
    }

    public function store(Request $request)
    {
        $response = ['message' => 'Ocurrió un error', 'error' => true, 'code' => 500, 'data' => []];
        try {
            DB::beginTransaction();
            if (!$request->id) {
                $obj = new Author();
                $response['message'] = 'Creación exitosa';
            } else {
                $obj = Author::find($request->id);
                // * Elimna previamente todos sus libros relacionados de la tabla PIVOT entre libros
                foreach ($obj->yourBooks as $item) {
                    $obj->yourBooks()->detach($item->id);
                }
                $response['message'] = 'Modificación exitosa';
            }
            $obj->fill(['name' => $request->name, 'firstSurname' => $request->firstSurname, 'secondSurname' => $request->secondSurname]);
            $obj->save();
            // * Almacena en la tabla PIVOT los id de los libros recibidos
            foreach ($request->your_books as $item) {
                $obj->yourBooks()->attach($item);
            }
            $response['data'] = Author::with('yourBooks')->where('id', $obj->id)->first();;
            $response['error'] = false;
            $response['code'] = 201;
            DB::commit();
        } catch (Exception $e) {
            $response['message'] = 'Ocurrió un error';
            DB::rollBack();
        } finally {
            return response()->json($response, $response['code']);
        }
    }

    public function show($id)
    {
        $response = ['message' => 'Ocurrió un error', 'error' => true, 'code' => 500, 'data' => []];
        try {
            $obj = Author::with('yourBooks')->where('id', $id)->first();
            if ($obj) {
                $response['message'] = 'Búsqueda exitosa';
            } else {
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

    public function destroy($id)
    {
        $response = ['message' => 'Ocurrió un error', 'error' => true, 'code' => 500, 'data' => []];
        try {
            $obj = Author::with('yourBooks')->where('id', $id)->first();
            if (sizeof($obj->yourBooks) == 0) {
                $obj->delete();
                $response['message'] = 'Eliminación exitosa';
                $response['data'] = $obj;
            } else {
                $response['message'] = 'No se puede eliminar porque contiene libros relacionados';
            }
            $response['error'] = false;
            $response['code'] = 200;
        } catch (Exception $e) {
        } finally {
            return response()->json($response, $response['code']);
        }
    }
}
