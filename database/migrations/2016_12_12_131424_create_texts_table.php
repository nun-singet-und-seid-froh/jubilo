<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTextsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('texts', function (Blueprint $table) {
        $table->increments('id');
        $table->timestamps();
        $table->string('title');
        
        $table->integer('pretext_id');
        $table->integer('lyricist_id');
       });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('texts');
    }
}
