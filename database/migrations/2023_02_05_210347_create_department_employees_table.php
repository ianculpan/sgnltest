<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
 /**
  * Run the migrations.
  *
  * @return void
  */
 public function up()
 {
  Schema::create('department_employees', function (Blueprint $table) {
   $table->id();
   $table->unsignedBigInteger('departments_id')->index();
   $table->foreign('departments_id')
    ->references('id')
    ->on('departments');
   $table->unsignedBigInteger('employees_id')->index();
   $table->foreign('employees_id')
    ->references('id')
    ->on('employees');
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
  Schema::dropIfExists('department_employees');
 }
};
