<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Holiday extends Migration{
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('holidays', function(Blueprint $table){
           $table->bigIncrements('user_id');
           $table->increments('id');
           $table->date('day');
           $table->string('description');
           $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
         Schma::drop('holidays');
    }
}
