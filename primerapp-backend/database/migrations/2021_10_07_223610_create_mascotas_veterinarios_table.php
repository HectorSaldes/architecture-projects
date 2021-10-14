<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMascotasVeterinariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    // * Después esta función
    public function up()
    {
        Schema::create('mascotas_veterinarios', function (Blueprint $table) {
            $table->unsignedBigInteger('mascotas_id')->nullable(); // ? Crea campos mascotas_id en la taba
            $table->foreign('mascotas_id')->references('id')->on('mascotas'); // ? Hace la relación

            $table->unsignedBigInteger('veterinarios_id')->nullable(); // ? Crea campos mascotas_id en la taba
            $table->foreign('veterinarios_id')->references('id')->on('veterinarios'); // ? Hace la relación
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    // * Primero ejecuta está función
    public function down()
    {
        Schema::dropIfExists('mascotas_veterinarios');
    }
}
