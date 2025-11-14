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
    Schema::create('loan_infos', function (Blueprint $table) {
      $table->uuid('id')->primary();
      $table->double('loan_amount');
      $table->string('loan_term');
      $table->string('loan_type');
      $table->double('share_capital');
      $table->double('savings');
      $table->string('membership_type');
      $table->string('payment_method');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('loan_infos');
  }
};
