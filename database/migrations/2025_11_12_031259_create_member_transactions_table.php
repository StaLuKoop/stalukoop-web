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
    Schema::create('member_transactions', function (Blueprint $table) {
      $table->id();
      $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
      $table->enum('type', ['Share Capital', 'Savings']);
      $table->decimal('amount', 12, 2);
      $table->string('payment_mode', 50);
      $table->string('payment_reference', 100);
      $table->string('proof_of_payment_path')->nullable();
      $table->enum('status', ['Pending', 'Verified', 'Rejected'])->default('Pending');
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
    Schema::dropIfExists('member_transactions');
  }
};
