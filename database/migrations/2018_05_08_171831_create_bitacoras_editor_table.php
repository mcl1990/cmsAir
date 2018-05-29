<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBitacorasEditorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable('bitacoras_editor') === false){

            Schema::create('bitacoras_editor', function (Blueprint $table) {
                $table->increments('id');
                $table->string('modulo');
                $table->integer('accion_id');
                $table->integer('registro_id');
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
        Schema::dropIfExists('bitacoras_editor');
    }
}
