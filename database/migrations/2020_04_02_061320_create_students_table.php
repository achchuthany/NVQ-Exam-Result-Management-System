<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->char('reg_no',30)->unique();
            $table->char('title',10)->nullable();
            $table->string('fullname');
            $table->string('shortname');
            $table->char('gender',10);
            $table->char('civil_status',10)->nullable();
            $table->string('email')->unique();
            $table->char('nic',15)->unique();
            $table->date('date_birth');
            $table->char('phone',15);
            $table->string('address')->nullable();
            $table->integer('zip')->nullable();
            $table->char('district',100)->nullable();
            $table->char('divisional',100)->nullable();
            $table->char('province',100)->nullable();
            $table->char('blood',5)->nullable();
            $table->string('emergency_name')->nullable();
            $table->string('emergency_address')->nullable();
            $table->char('emergency_phone',15)->nullable();
            $table->char('emergency_relationship',50)->nullable();
            $table->char('status',20)->default('Following');
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
        Schema::dropIfExists('students');
    }
}
