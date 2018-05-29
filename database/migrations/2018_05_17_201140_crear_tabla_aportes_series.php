<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaAportesSeries extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    
    public function up()
    {
        if(Schema::hasTable('aportes_series') === false) {

            Schema::create('aportes_series', function (Blueprint $table) {
                $table->increments('id');
                $table->string('titulo',100);
                $table->string('duracion',10);
                $table->integer('serie_id');
                $table->integer('servidor_id');
                $table->integer('resolucion_id');
                $table->integer('audio_id');
                $table->integer('video_id');
                $table->integer('user_id');
                $table->double('peso');
                $table->integer('tamano_archivo_id');
                $table->integer('idioma_id');
                $table->double('subtitulo_id');
                $table->integer('status');
                $table->integer('temporada_id');
                $table->integer('episodio');
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
        Schema::dropIfExists('aportes_series');
    }
}
