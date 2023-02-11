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
  Schema::create('building_departments', function (Blueprint $table) {
   $table->id();
   $table->unsignedBigInteger('department_id')->index();
   $table->foreign('department_id')
    ->references('id')
    ->on('departments');
   $table->unsignedBigInteger('building_id')->index();
   $table->foreign('building_id')
    ->references('id')
    ->on('buildings');
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
  Schema::dropIfExists('building_departments');
 }
};
