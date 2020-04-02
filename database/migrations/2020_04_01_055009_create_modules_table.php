<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modules', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('course_id')->unsigned();
            $table->foreign('course_id')->references('id')->on('courses')->onUpdate('cascade');
            $table->string('code')->unique();
            $table->string('name');
            $table->string('aim')->nullable();
            $table->integer('learning_hours');
            $table->string('resources')->nullable();
            $table->string('learning_outcomes')->nullable();
            $table->tinyInteger('semester_id');
            $table->string('exam_type');
            $table->string('reference')->nullable();
            $table->string('relative_units')->nullable();
            $table->integer('lecture_hours');
            $table->integer('practical_hours');
            $table->integer('self_study_hours');
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
        Schema::dropIfExists('modules');
    }
}
