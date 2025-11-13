<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void
  {
    Schema::create('la_employment_info', function (Blueprint $table) {
      $table->uuid('id')->primary();
      $table->string('empployer_or_business_name')->nullable();
      $table->string('empployer_or_business_address')->nullable();
      $table->enum('type_of_employment', ['Regular', 'Contractual', 'Self-Employed', 'Unemployed', 'Others'])->nullable();
      $table->enum('income_level', ['Low', 'Average', 'High'])->nullable();
      $table->timestamps();
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('la_employment_info');
  }
};
