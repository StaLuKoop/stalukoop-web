<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void
  {
    Schema::create('loan_info', function (Blueprint $table) {
      $table->uuid('id')->primary();
      $table->double('loan_amount')->default(0);
      $table->enum('loan_term', ['3 months', '6 months', '12 months', '24 months', 'Others'])->nullable();
      $table->enum('loan_type', ['Personal', 'Emergency', 'Business', 'Educational', 'Others'])->nullable();
      $table->double('share_capital')->default(0);
      $table->double('savings')->default(0);
      $table->enum('membership_type', ['Regular', 'Associate'])->nullable();
      $table->enum('payment_method', ['Cash', 'Bank', 'GCash', 'Payroll Deduction', 'Others'])->nullable();
      $table->timestamps();
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('loan_info');
  }
};
