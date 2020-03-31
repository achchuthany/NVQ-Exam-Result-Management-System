<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->bigInteger('department_id')->unsigned();
            $table->foreign('department_id')->references('id')->on('departments')->onUpdate('cascade');
            $table->bigInteger('nvq_id')->unsigned();
            $table->foreign('nvq_id')->references('id')->on('nvqs')->onUpdate('cascade');
            $table->id();
            $table->string('name');
            $table->integer('duration');
            $table->integer('ojt_duration'); 
            $table->tinyInteger('status')->default(1);   
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
        Schema::dropIfExists('courses');
    }
}
