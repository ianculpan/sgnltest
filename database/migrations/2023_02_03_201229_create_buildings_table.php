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
  Schema::create('buildings', function (Blueprint $table) {
   $table->id();
   $table->string('building_name');
   $table->unsignedBigInteger('location_id')->index();
   $table->foreign('location_id')
    ->references('id')
    ->on('locations');
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
  Schema::dropIfExists('buildings');
 }
};
