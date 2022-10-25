<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExplodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('explodes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('note')->nullable(true)->default(NULL);
            $table->integer('place');
            $table->integer('speed');
            $table->integer('quantity');
            $table->integer('size');
            $table->string('colors');
            $table->integer('count');
            $table->boolean('front_bigger')->default(true);
            $table->integer('order')->nullable(true)->default(NULL);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('explodes');
    }
}
