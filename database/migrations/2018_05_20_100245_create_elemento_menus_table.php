<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateElementoMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable('elementos_menu') === false) {
            Schema::create('elementos_menu', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('menu_categoria_id');
                $table->string('titulo');
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
        Schema::dropIfExists('elementos_menu');
    }
}
