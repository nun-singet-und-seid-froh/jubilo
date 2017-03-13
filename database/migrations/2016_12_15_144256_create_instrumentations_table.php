<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstrumentationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instrumentations', function (Blueprint $table){
          $table->increments('id');
          $table->timestamps();
          $table->string('name');
          
          $table->integer('numberOfVoices');
          $table->integer('ensemble_id');
          $table->integer('alias_id');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('instrumentations');
    }
}
