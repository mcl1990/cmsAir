<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaWidgets extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable('widgets') === false) {

            Schema::create('widgets', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('tipo_widget_id');
                $table->string('titulo',25);
                $table->string('descripcion',50);
                $table->smallinteger('status');
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
        Schema::dropIfExists('widgets');
    }
}
