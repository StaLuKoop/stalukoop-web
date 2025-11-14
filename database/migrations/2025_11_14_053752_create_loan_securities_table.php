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
    Schema::create('loan_securities', function (Blueprint $table) {
      $table->uuid('id')->primary();
      $table->boolean('provide_collateral_for_loan');
      $table->string('collateral_type')->nullable();
      $table->double('collateral_value')->nullable();
      $table->string('collateral_document')->nullable();
      $table->string('updated_collateral_document')->nullable();
      $table->string('savings_intended_for')->nullable();
      $table->boolean('member_health_condition_affect_loan_status')->default(false);
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('loan_securities');
  }
};
