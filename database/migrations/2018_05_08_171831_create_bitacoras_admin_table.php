<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBitacorasAdminTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable('bitacoras_admin') === false){

            Schema::create('bitacoras_admin', function (Blueprint $table) {
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
        Schema::dropIfExists('bitacoras_admin');
    }
}
