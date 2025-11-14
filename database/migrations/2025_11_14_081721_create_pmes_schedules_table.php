<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void
  {
    Schema::create('pmes_schedules', function (Blueprint $table) {
      $table->id();
      $table->date('date');
      $table->string('time', 50);
      $table->enum('mode', ['Online', 'Face-to-Face']);
      $table->integer('available_slots');
      $table->string('attendance_code', 20);
      $table->string('online_link')->nullable();
      $table->foreignId('created_by')->constrained('users');
      $table->timestamps();
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('pmes_schedules');
  }
};
