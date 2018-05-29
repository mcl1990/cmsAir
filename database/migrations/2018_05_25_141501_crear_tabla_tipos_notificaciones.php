<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaTiposNotificaciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         if(Schema::hasTable('tipos_notificaciones') === false) {

            Schema::create('tipos_notificaciones', function (Blueprint $table) {
                $table->increments('id');
                $table->string('tipo_notificacion',25);
                $table->string('icono',25);
                $table->string('style',25);
                $table->text('mensaje')->nullable();
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
        Schema::dropIfExists('tipos_notificaciones');
    }
}
