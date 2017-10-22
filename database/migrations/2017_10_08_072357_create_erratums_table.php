<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateErratumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('erratum', function (Blueprint $table){
            $table->increments('id');
            $table->timestamps();
        
            $table->integer('piece_id');
            $table->integer('bar_number')->nullable();
			$table->string('voice')->nullable();
			$table->text('description');
			$table->text('refusal_comment');
			$table->enum('status', ['submitted', 'approved', 'refused', 'closed']);
			$table->string('provider_email')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    	Schema::dropIfExists('erratum');
    }
}
