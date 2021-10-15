<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // * Atributos propios
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('isbn', 15);
            $table->string('title', 255);
            $table->text('description')->nullable();
            $table->date('publication_date')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('editorial_id')->nullable();
        });

        // * Llaves foraneas
        Schema::table('books', function (Blueprint $table) {
           $table->foreign('category_id')->references('id')->on('categories');
           $table->foreign('editorial_id')->references('id')->on('editorials');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
}
