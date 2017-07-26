<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('sources', function (Blueprint $table) {
        $table->increments('id');
        $table->timestamps();
        $table->string('title');
        $table->string('editors');
        $table->integer('year');
        $table->string('publisher');
        $table->string('publisherAddress');
        $table->string('url');
        $table->string('comment');
        $table->string('license');
        $table->string('fileName');
        $table->boolean('isPubliclyAvailable');
      });
      
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       Schema::dropIfExists('sources');
    }
}
