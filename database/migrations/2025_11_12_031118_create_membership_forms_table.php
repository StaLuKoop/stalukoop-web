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
    Schema::create('membership_forms', function (Blueprint $table) {
      $table->id();
      $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

      // Personal Information
      $table->string('first_name');
      $table->string('middle_name')->nullable();
      $table->string('last_name');
      $table->string('email');
      $table->string('contact_number', 20);
      $table->text('address');

      // Cooperative-related answers
      $table->text('goal_answer');
      $table->text('coop_meaning_answer');

      // Uploaded Files
      $table->string('certificate_path')->nullable();
      $table->string('proof_of_payment_path')->nullable();

      // Review & Status
      $table->enum('status', ['Pending', 'Approved', 'Rejected'])->default('Pending');
      $table->text('rejection_reason')->nullable();

      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('membership_forms');
  }
};
