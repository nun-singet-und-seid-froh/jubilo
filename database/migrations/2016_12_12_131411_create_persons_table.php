<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persons', function (Blueprint $table) {
          $table->increments('id');
          $table->timestamps();
          $table->string('firstName')->default(NULL)->nullable();
          $table->string('interName')->default(NULL)->nullable();
          $table->string('lastName')->default(NULL);
          $table->unique(['firstName', 'interName', 'lastName']);
          
          $table->integer('birthYear')->default(NULL);
          $table->boolean('birthYearCertainty')->default(true);          
          $table->integer('deathYear')->default(NULL);
          $table->boolean('deathYearCertainty')->default(true);
          $table->integer('visits')->default(0);
          $table->string('furtherReading');
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
      Schema::dropIfExists('persons');
    }
}
