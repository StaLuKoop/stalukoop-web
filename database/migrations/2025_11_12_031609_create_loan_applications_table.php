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
      $table->id();
      $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
      $table->string('loan_type', 100);
      $table->decimal('amount_requested', 12, 2);
      $table->integer('term_months');
      $table->decimal('interest_rate', 5, 2);
      $table->text('purpose');
      $table->string('proof_of_income_path')->nullable();
      $table->string('valid_id_path')->nullable();
      $table->enum('status', ['Pending', 'Approved', 'Rejected'])->default('Pending');
      $table->text('rejection_reason')->nullable();
      $table->timestamp('approved_at')->nullable();
      $table->foreignId('approved_by')->nullable()->constrained('users')->onDelete('set null');
      $table->timestamps();
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
