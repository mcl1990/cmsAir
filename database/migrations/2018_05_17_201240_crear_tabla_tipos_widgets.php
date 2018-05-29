<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaTiposWidgets extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable('tipos_widgets') === false) {

            Schema::create('tipos_widgets', function (Blueprint $table) {
                $table->increments('id');
                $table->string('titulo',25);
                $table->string('descripcion',25);
                $table->string('icono',25);
                $table->text('estructura');
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
        Schema::dropIfExists('tipos_widgets');
    }
}
