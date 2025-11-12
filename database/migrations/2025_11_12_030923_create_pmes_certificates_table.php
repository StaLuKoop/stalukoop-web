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
    Schema::create('pmes_certificates', function (Blueprint $table) {
      $table->id();
      $table->foreignId('attendee_id')->constrained('pmes_attendees')->onDelete('cascade');
      $table->string('certificate_number', 50)->unique();
      $table->string('file_path', 255)->nullable();
      $table->foreignId('issued_by')->constrained('users')->onDelete('cascade');
      $table->dateTime('issued_at');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('pmes_certificates');
  }
};
