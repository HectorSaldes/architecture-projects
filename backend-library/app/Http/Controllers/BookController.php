<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;


class BookController extends Controller
{

    public function index()
    {
        $response = ['message' => 'Ocurrió un error', 'error' => true, 'code' => 500, 'data' => []];
        try {
            $response['data'] = Book::all();
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
            $dataUpdate = ['isbn' => $request->isbn, 'title' => $request->title, 'description' => $request->description, 'publication_date' => $request->publication_date, 'category_id' => $request->category_id, 'editorial_id' => $request->editorial_id];
            if (!$request->id) {
                $obj = new Book();
                $response['message'] = 'Creación exitosa';
            } else {
                $obj = Book::find($request->id);
                if ($request->isbn == $obj->isbn) {
                    $dataUpdate = ['title' => $request->title, 'description' => $request->description, 'publication_date' => $request->publication_date,
                        'category_id' => $request->category_id, 'editorial_id' => $request->editorial_id];
                }
                // * Elimna previamente todos sus libros relacionados de la tabla PIVOT entre libros
                foreach ($obj->yourAuthors as $item) {
                    $obj->yourAuthors()->detach($item->id);
                }
                $response['message'] = 'Modificación exitosa';
            }
            $obj->fill($dataUpdate);
            $obj->save();
            // * Almacena en la tabla PIVOT los id de los libros recibidos
            foreach ($request->your_authors as $item) {
                $obj->yourAuthors()->attach($item);
            }
            $response['data'] = Book::with('yourAuthors')->where('id', $obj->id)->first();;
            $response['error'] = false;
            $response['code'] = 201;
            DB::commit();
            return response()->json($response, $response['code']);
        } catch (QueryException $e) {
            $response['message'] = 'No se puede almacenar un mismo ISBN';
        } finally {
            return response()->json($response, $response['code']);
        }
    }

    public function show($id)
    {
        $response = ['message' => 'Ocurrió un error', 'error' => true, 'code' => 500, 'data' => []];
        try {
            $obj = Book::with(['yourCategory', 'yourEditorial', 'yourAuthors'])->where('id', $id)->first();
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
            $obj = Book::with('yourAuthors')->where('id', $id)->first();
            if (sizeof($obj->yourAuthors) == 0) {
                $obj->delete();
                $response['message'] = 'Eliminación exitosa';
                $response['data'] = $obj;
            } else {
                $response['message'] = 'No se puede eliminar porque contiene autores relacionados';
            }
            $response['error'] = false;
            $response['code'] = 200;
        } catch (Exception $e) {
        } finally {
            return response()->json($response, $response['code']);
        }
    }
}
