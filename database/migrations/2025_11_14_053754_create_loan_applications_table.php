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
    Schema::create('loan_applications', function (Blueprint $table) {
      $table->uuid('id')->primary();
      $table->uuid('personal_info');
      $table->uuid('employment_info');
      $table->uuid('loan_info');
      $table->uuid('loan_security');
      $table->timestamps();

      $table->foreign('personal_info')->references('id')->on('personal_infos')->cascadeOnDelete();
      $table->foreign('employment_info')->references('id')->on('la_employment_infos')->cascadeOnDelete();
      $table->foreign('loan_info')->references('id')->on('loan_infos')->cascadeOnDelete();
      $table->foreign('loan_security')->references('id')->on('loan_securities')->cascadeOnDelete();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('loan_applications');
  }
};
