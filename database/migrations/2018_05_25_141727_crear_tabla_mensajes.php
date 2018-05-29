<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaMensajes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         if(Schema::hasTable('mensajes') === false) {

            Schema::create('mensajes', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('motivo_id');
                $table->text('mensaje');
                $table->text('respuesta')->nullable();
                $table->integer('status');
                $table->integer('user_id');
                $table->integer('admin_id')->nullable();
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
        Schema::dropIfExists('mensajes');
    }
}
