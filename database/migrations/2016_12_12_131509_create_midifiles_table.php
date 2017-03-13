<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMidifilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('midifiles', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            
            $table->string('fileName');
            $table->string('title');
            
            $table->integer('piece_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('midifiles');
    }
}
