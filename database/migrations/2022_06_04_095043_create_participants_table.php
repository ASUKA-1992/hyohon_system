<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParticipantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participants', function (Blueprint $table) {
            $table->id();
            $table->integer('meeting_id');
            $table->string('name')->nullable(true)->default(NULL);
            $table->integer('owner_type')->default(1);
            $table->string('role_name')->nullable(true)->default(NULL);
            $table->string('role_name_sub')->nullable(true)->default(NULL);
            $table->string('action_name')->nullable(true)->default(NULL);
            $table->string('action_name_sub')->nullable(true)->default(NULL);
            $table->integer('answer1')->nullable(true)->default(NULL);
            $table->integer('answer2')->nullable(true)->default(NULL);
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
        Schema::dropIfExists('participants');
    }
}
