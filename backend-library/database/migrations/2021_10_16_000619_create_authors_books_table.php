<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuthorsBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('authors_books', function (Blueprint $table) {
            // * Creación de los atributos
            $table->unsignedBigInteger('authors_id')->nullable();
            $table->unsignedBigInteger('books_id')->nullable();

            // * Creación de las referencias foráneas
            $table->foreign('authors_id')->references('id')->on('authors');
            $table->foreign('books_id')->references('id')->on('books');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('authors_books');
    }
}
