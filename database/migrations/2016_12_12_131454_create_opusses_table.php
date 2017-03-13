<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOpussesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('opusses', function (Blueprint $table) {
        $table->increments('id');
        $table->timestamps();
        $table->string('title');
        $table->string('opusNumber');
        $table->string('catalogueRaisonee');

        $table->integer('composer_id');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('opusses');
    }
}
