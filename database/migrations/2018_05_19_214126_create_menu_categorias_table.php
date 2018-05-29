<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuCategoriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable('menus_categorias') === false) {
            Schema::create('menus_categorias', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('categoria_id');
                $table->string('icono',20);
                $table->string('titulo',20);
                $table->string('url',50);
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
        Schema::dropIfExists('menus_categorias');
    }
}
