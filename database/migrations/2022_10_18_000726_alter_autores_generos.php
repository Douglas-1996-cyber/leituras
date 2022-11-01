<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterAutoresGeneros extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('autores', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->default(2);
            $table->foreign('user_id')->references('id')->on('users');
       
        });
        
        Schema::table('generos', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->default(2);
            $table->foreign('user_id')->references('id')->on('users');
       
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
