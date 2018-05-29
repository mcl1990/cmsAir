<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaAportesLinkesNoLikes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         if(Schema::hasTable('aportes_likes_no_likes') === false) {

            Schema::create('aportes_likes_no_likes', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('aporte_id');
                $table->integer('categoria_id');
                $table->integer('user_id');
                $table->integer('status');
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
        Schema::dropIfExists('aportes_likes_no_likes');
    }
}
