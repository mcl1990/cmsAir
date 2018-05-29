<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable('users') === false){

            Schema::create('users', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->string('email')->unique();
                $table->string('password');
                $table->integer('perfil_id');
                $table->integer('likes')->default(0);
                $table->integer('no_likes')->default(0);
                $table->integer('seguidores')->default(0);
                $table->integer('seguidos')->default(0);
                $table->integer('total_aportes')->default(0);
                $table->integer('avatar_id')->default(1);
                $table->rememberToken();
                // $table->timestamps();
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
        Schema::dropIfExists('users');
    }
}
