<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAportesPeliculasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable('aportes_peliculas') === false){

            Schema::create('aportes_peliculas', function (Blueprint $table) {
                $table->increments('id');
                $table->string('titulo');
                $table->text('enlace');
                $table->integer('visto')->default(0);
                $table->integer('servidor_id');
                $table->integer('pelicula_id');
                $table->integer('resolucion_id');
                $table->integer('audio_id');
                $table->integer('video_id');
                $table->integer('user_id');
                $table->integer('subtitulo_id');
                $table->integer('idioma_id');
                $table->double('peso');
                $table->integer('tamano_archivo_id');
                $table->integer('status');
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
        Schema::dropIfExists('aportes_peliculas');
    }
}
