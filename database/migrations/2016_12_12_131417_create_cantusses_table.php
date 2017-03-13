<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCantussesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('cantusses', function (Blueprint $table) {
        $table->increments('id');
        $table->timestamps();
        $table->string('title');

        $table->integer('composer_id');
        $table->integer('source_id');        
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('cantusses');
    }
}
