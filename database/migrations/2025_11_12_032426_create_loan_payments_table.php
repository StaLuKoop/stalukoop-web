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
    Schema::create('loan_payments', function (Blueprint $table) {
      $table->id();
      $table->foreignId('loan_id')->constrained('loans')->onDelete('cascade');
      $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

      // Payment Details
      $table->decimal('amount_due', 12, 2);
      $table->decimal('amount_paid', 12, 2)->default(0);
      $table->date('due_date');
      $table->date('payment_date')->nullable();
      $table->string('payment_mode', 50);
      $table->string('proof_of_payment_path')->nullable();
      $table->enum('status', ['Pending Verification', 'Paid', 'Rejected'])->default('Pending Verification');
      $table->foreignId('verified_by')->nullable()->constrained('users')->onDelete('set null');
      $table->timestamp('verified_at')->nullable();

      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('loan_payments');
  }
};
