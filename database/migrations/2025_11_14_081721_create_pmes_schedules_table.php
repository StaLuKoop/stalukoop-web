<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void
  {
    Schema::create('pmes_schedules', function (Blueprint $table) {
      $table->uuid('id')->primary();

      $table->dateTime('scheduled_at');
      $table->enum('mode', ['Online', 'F2F']);
      $table->string('contact_number', 20)->nullable();

      $table->foreignId('user_id')->constrained('users');

      $table->timestamps();
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('pmes_schedules');
  }
};
