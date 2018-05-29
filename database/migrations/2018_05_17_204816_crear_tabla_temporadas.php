<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaTemporadas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable('temporadas') === false) {

            Schema::create('temporadas', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('serie_id');
                $table->integer('temporada');
                $table->string('episodios',50);
                $table->string('titulo',50);
                $table->string('descripcion',50)->nullable();
                $table->date('fecha_estreno')->nullable();
                $table->string('imagen',15)->nullable();
                $table->string('codigo',50);
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
        Schema::dropIfExists('temporadas');
    }
}
