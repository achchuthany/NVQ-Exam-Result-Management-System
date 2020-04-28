<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendanceSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendance_sessions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('module_id')->unsigned();
            $table->foreign('module_id')->references('id')->on('modules')->onUpdate('cascade');
            $table->bigInteger('academic_year_id')->unsigned();
            $table->foreign('academic_year_id')->references('id')->on('academic_years')->onUpdate('cascade');
            $table->date('date');
            $table->time('time_from');
            $table->time('time_to');
            $table->string('description')->nullable();
            $table->integer('present')->default(0);
            $table->integer('absent')->default(0);
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
        Schema::dropIfExists('attendance_sessions');
    }
}
