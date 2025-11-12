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
    Schema::create('loans', function (Blueprint $table) {
      $table->id();
      $table->foreignId('loan_application_id')->constrained('loan_applications')->onDelete('cascade');
      $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

      // Loan Details
      $table->decimal('approved_amount', 12, 2);
      $table->decimal('interest_rate', 5, 2);
      $table->integer('term_months');
      $table->date('start_date');
      $table->date('end_date');

      // Deductions & Net Proceeds
      $table->decimal('service_fee', 12, 2)->default(0);
      $table->decimal('share_capital', 12, 2)->default(0);
      $table->decimal('savings', 12, 2)->default(0);
      $table->decimal('loan_protection_plan', 12, 2)->default(0);
      $table->decimal('net_proceeds', 12, 2)->default(0);

      // Loan Status
      $table->enum('status', ['Ongoing', 'Completed', 'Defaulted'])->default('Ongoing');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('loans');
  }
};
