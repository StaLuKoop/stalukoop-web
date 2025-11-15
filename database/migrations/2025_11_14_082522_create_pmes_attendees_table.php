<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void
  {
    Schema::create('pmes_attendees', function (Blueprint $table) {
      $table->uuid('id')->primary();

      $table->foreignId('user_id')->constrained('users'); // users.id is BIGINT
      $table->foreignUuid('schedule_id')->constrained('pmes_schedules'); // UUID FK

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

  public function down(): void
  {
    Schema::dropIfExists('pmes_attendees');
  }
};
