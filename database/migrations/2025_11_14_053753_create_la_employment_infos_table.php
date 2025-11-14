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
    Schema::create('la_employment_infos', function (Blueprint $table) {
      $table->uuid('id')->primary();
      $table->string('empployer_or_business_name')->nullable();
      $table->string('empployer_or_business_address')->nullable();
      $table->string('type_of_employment');
      $table->string('income_level');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('la_employment_infos');
  }
};
