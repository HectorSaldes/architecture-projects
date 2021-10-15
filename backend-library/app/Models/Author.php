<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    protected $table = "authors";
    protected $fillable = [
        "id",
        "name",
        "firstSurname",
        "secondSurname"
    ];

    // ? Regresa los libros donde pertenece
    public function yourBooks()
    {
        return $this->belongsToMany(
            Book::class, // * Que tabla
            'authors_books', // * Tabla PIVOTE o intersección
            'authors_id', // * Donde estoy
            'books_id' // * Donde voy
        )->orderBy('publication_date', 'DESC'); // * Ordenar por la columna del más reciente al más antiguo
    }

    public $timestamps = false;
}
