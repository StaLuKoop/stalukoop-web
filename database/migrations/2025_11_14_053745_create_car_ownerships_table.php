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
    Schema::create('car_ownerships', function (Blueprint $table) {
      $table->uuid('id')->primary();
      $table->string('status');
      $table->string('monthly_amortization')->nullable();
      $table->string('vehicle_type');
      $table->date('year_acquired')->nullable();
      $table->string('financing_institution')->nullable();
      $table->string('loan_term')->nullable();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('car_ownerships');
  }
};
