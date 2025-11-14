<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('permanent_homes', function (Blueprint $table) {
      $table->uuid('id')->primary();
      $table->string('permanent_home_address');
      $table->string('housing_status');
      $table->integer('monthly_rent')->nullable();
      $table->integer('months_of_renting')->nullable();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('permanent_homes');
  }
};
