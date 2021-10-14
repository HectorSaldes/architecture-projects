<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


/*
    ? Actividad 3. Arquitectura cliente - servidor (primera parte)
    * Saldaña Espinoza Hector
    * 7B
    ! Elaboración: 25 de septiembre del 2021
*/
class CreateMascotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mascotas', function (Blueprint $table) {
            // ? Creará estos campos en nuestra tabla
            $table->id();
            $table->string('raza',45)->nullable(); // ? No podrá ser nulo
            $table->string('tamanio',30);

            // * $table->text('descripcion');
            // * $table->text('fecha');


            // $table->unsignedBigInteger('tipo_mascotas_id')->nullable();  ? agregar el campo de la foranea
        });

        /* Realiza la asignación o une las llaves
        Schema::table('mascotas', function (Blueprint $table) {
            $table->foreign('tipo_mascotas_id')->references('id')->on('tipo_mascotas');
        });
        */
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // ? Elimina si existe
        Schema::dropIfExists('mascotas');
    }
}
