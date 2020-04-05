<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('department_id')->unsigned();
            $table->foreign('department_id')->references('id')->on('departments')->onUpdate('cascade');
            $table->char('title',10)->nullable();
            $table->string('fullname');
            $table->string('shortname');
            $table->char('epf',10)->unique();
            $table->date('date_join');
            $table->date('date_end')->nullable();
            $table->string('position');
            $table->string('position_type');
            $table->char('gender',10);
            $table->char('civil_status',10)->nullable();
            $table->string('email')->unique();
            $table->char('nic',20)->unique();
            $table->char('phone',15);
            $table->date('date_birth');
            $table->string('address')->nullable();
            $table->integer('zip')->nullable();
            $table->char('district',100)->nullable();
            $table->char('divisional',100)->nullable();
            $table->char('province',100)->nullable();
            $table->char('blood',5)->nullable();
            $table->char('status',20)->default('Working');
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
        Schema::dropIfExists('employees');
    }
}
