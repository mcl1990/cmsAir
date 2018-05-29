<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaLinksSeries extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::connection('secundaria')->hasTable('links_series') === false) {

            Schema::connection('secundaria')->create('links_series', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('aporte_serie_id');
                $table->text('url');
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
        Schema::connection('secundaria')->dropIfExists('links_series');
    }
}
