<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLinkPeliculasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::connection('secundaria')->hasTable('link_peliculas') === false) {

            Schema::connection('secundaria')->create('link_peliculas', function (Blueprint $table) {
                $table->increments('id');
                $table->text('url');
                $table->integer('aporte_pelicula_id');
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
        Schema::connection('secundaria')->dropIfExists('link_peliculas');
    }
}
