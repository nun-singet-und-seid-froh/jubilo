<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePiecesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('pieces', function (Blueprint $table)
        {
          $table->increments('id');
          $table->timestamps();
          $table->string('title')->default(NULL);
          $table->integer('editionNumber')->default(0);
          $table->integer('year')->default(NULL)->nullable();
          $table->string('permalink')->default(0);
          $table->integer('visits')->default(0);

          $table->string('sourcecode')->default(0);          
          $table->integer('sheet_id')->unsigned();
          $table->integer('instrumentation_id')->unsigned();
          $table->integer('epoque_id')->unsigned();
          $table->integer('text_id')->unsigned();
          $table->integer('difficulty_id')->unsigned();
          $table->integer('compilation_id')->unsigned();
          $table->integer('opus_id')->unsigned()->nullable();                    
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::drop('pieces');
    }
}
