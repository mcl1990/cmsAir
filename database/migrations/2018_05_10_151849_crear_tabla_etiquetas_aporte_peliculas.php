<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaEtiquetasAportePeliculas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('etiquetas_aporte_pelicula') === false) {
            Schema::create('etiquetas_aporte_pelicula', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('etiqueta_id');
                $table->integer('aporte_pelicula_id');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('etiquetas_aporte_pelicula');
    }
}
