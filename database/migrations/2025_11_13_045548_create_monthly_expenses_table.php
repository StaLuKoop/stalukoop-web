<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void
  {
    Schema::create('monthly_expenses', function (Blueprint $table) {
      $table->uuid('id')->primary();
      $table->string('food')->nullable();
      $table->string('electric_bill')->nullable();
      $table->string('credit_card')->nullable();
      $table->string('water_bill')->nullable();
      $table->string('cable_or_internet')->nullable();
      $table->string('tuition_fee')->nullable();
      $table->string('others')->nullable();
      $table->timestamps();
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('monthly_expenses');
  }
};
