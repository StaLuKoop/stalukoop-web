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
    Schema::create('home_addresses', function (Blueprint $table) {
      $table->uuid('id')->primary();
      $table->uuid('permanent_home')->nullable();
      $table->uuid('present_home')->nullable();
      $table->timestamps();

      $table->foreign('permanent_home')->references('id')->on('permanent_homes')->nullOnDelete();
      $table->foreign('present_home')->references('id')->on('present_homes')->nullOnDelete();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('home_addresses');
  }
};
