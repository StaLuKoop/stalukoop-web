<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void
  {
    Schema::create('loan_security', function (Blueprint $table) {
      $table->uuid('id')->primary();

      $table->boolean('provide_collateral_for_loan')->default(false);
      $table->enum('collateral_type', ['Vehicle', 'Real Estate', 'Savings', 'Others'])->nullable();
      $table->double('collateral_value')->nullable();
      $table->enum('collateral_document', ['Title', 'Deed of Sale', 'OR/CR', 'Others'])->nullable();
      $table->string('updated_collateral_document')->nullable();
      $table->enum('savings_intended_for', ['Collateral', 'Emergency', 'Investment', 'Others'])->nullable();
      $table->boolean('member_health_condition_affect_loan_status')->default(false);

      $table->timestamps();
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('loan_security');
  }
};
