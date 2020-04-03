<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentEnrollsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_enrolls', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('student_id')->unsigned();
            $table->foreign('student_id')->references('id')->on('students')->onUpdate('cascade');
        
            $table->bigInteger('academic_year_id')->unsigned();
            $table->foreign('academic_year_id')->references('id')->on('academic_years')->onUpdate('cascade');
        
            $table->bigInteger('course_id')->unsigned();
            $table->foreign('course_id')->references('id')->on('courses')->onUpdate('cascade');
            
            $table->enum('course_mode', ['Full Time', 'Part Time','Short Time']);
            $table->date('enroll_date');
            $table->date('completion_date')->nullable();
            $table->enum('status', ['Following', 'Completed','Droupout','Long Absent'])->default('Following');
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
        Schema::dropIfExists('student_enrolls');
    }
}
