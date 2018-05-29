<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeliculasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable('peliculas') === false) {

            Schema::create('peliculas', function (Blueprint $table) {
                $table->increments('id');
                $table->string('titulo',100);
                $table->smallinteger('duracion');
                $table->text('descripcion');
                $table->date('fecha');
                $table->string('imagen',20)->nullable();
                $table->string('codigo',20);
                $table->double('calificacion');
                $table->boolean('status');
                $table->integer('user_id');
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
        Schema::dropIfExists('peliculas');
    }
}
