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
    Schema::create('pmes_attendees', function (Blueprint $table) {
      $table->id();
      $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
      $table->foreignId('schedule_id')->constrained('pmes_schedules')->onDelete('cascade');
      $table->string('email', 255);
      $table->string('contact', 20);
      $table->text('goal_answer');
      $table->text('coop_meaning_answer');
      $table->string('entered_code', 20)->nullable();
      $table->enum('status', ['Pending', 'Approved', 'Attended', 'Absent'])->default('Pending');
      $table->boolean('certificate_issued')->default(false);
      $table->dateTime('attended_at')->nullable();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('pmes_attendees');
  }
};
