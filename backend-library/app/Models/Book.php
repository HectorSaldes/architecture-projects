<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $table = "books";
    protected $fillable = [
        "id",
        "isbn",
        "title",
        "description",
        "publication_date",
        "category_id",
        "editorial_id",

    ];

    public $timestamps = false;

    // ? Regresa la categoría donde pertenece
    public function yourCategory(){
        return $this->belongsTo(Category::class, 'category_id');
    }

    // ? Regresa la editorial donde pertenece
    public function yourEditorial(){
        return $this->belongsTo(Editorial::class, 'editorial_id');
    }

    // ? Regresa los autores donde pertenece
    public function yourAuthors(){
        return $this->belongsToMany(
            Author::class, // * Que tabla
            'authors_books', // * Tabla PIVOTE o intersección
            'books_id', // * Donde estoy
            'authors_id' // * Donde voy
        );
    }


}
