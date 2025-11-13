<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void
  {
    Schema::create('car_ownership', function (Blueprint $table) {
      $table->uuid('id')->primary();
      $table->string('status');
      $table->string('monthly_amortization')->nullable();
      $table->enum('vehicle_type', ['Car', 'Motorcycle', 'Truck', 'Van', 'Others']);
      $table->date('year_acquired')->nullable();
      $table->string('financing_institution')->nullable();
      $table->string('loan_term')->nullable();
      $table->timestamps();
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('car_ownership');
  }
};
