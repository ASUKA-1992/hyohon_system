<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToMeetingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('meetings', function (Blueprint $table) {
        	$table->dateTime('start_date')->nullable(true)->default(NULL);
            $table->dateTime('status1_end_date')->nullable(true)->default(NULL);
            $table->dateTime('status2_end_date')->nullable(true)->default(NULL);
            $table->string('tag')->nullable(true)->default(NULL);
            $table->text('comment')->nullable(true)->default(NULL);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('meetings', function (Blueprint $table) {
            //
        });
    }
}
