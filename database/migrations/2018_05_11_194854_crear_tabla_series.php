<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaSeries extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable('series') === false) {

            Schema::create('series', function (Blueprint $table) {
                $table->increments('id');
                $table->string('codigo',20);
                $table->string('titulo',100);
                $table->text('descripcion');
                $table->string('imagen',15);
                $table->smallinteger('status');
                $table->integer('user_id');
                $table->date('primera_emision');
                $table->integer('temporadas');
                $table->integer('episodios');
                $table->double('calificacion');
                $table->integer('estado');
                $table->date('ultima_emision');
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
        Schema::dropIfExists('series');
    }
}
