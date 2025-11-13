<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void
  {
    Schema::create('loan_application', function (Blueprint $table) {
      $table->uuid('id')->primary();

      $table->uuid('personal_info')->nullable();
      $table->uuid('employment_info')->nullable();
      $table->uuid('loan_info')->nullable();
      $table->uuid('loan_security')->nullable();

      $table->timestamps();

      // Foreign key relations
      $table->foreign('personal_info')->references('id')->on('personal_info')->nullOnDelete();
      $table->foreign('employment_info')->references('id')->on('la_employment_info')->nullOnDelete();
      $table->foreign('loan_info')->references('id')->on('loan_info')->nullOnDelete();
      $table->foreign('loan_security')->references('id')->on('loan_security')->nullOnDelete();
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('loan_application');
  }
};
