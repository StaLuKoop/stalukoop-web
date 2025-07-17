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
    Schema::create('members', function (Blueprint $table) {
      $table->id();
      $table->foreignId('user_id')->unique()->constrained()->onDelete('cascade');
      $table->string('cdv_number')->nullable();
      $table->enum('membership_status', ['pending', 'regular', 'closed'])->default('pending');
      $table->enum('activity_status', ['active', 'inactive'])->default('active');
      $table->date('date_of_birth')->nullable();
      $table->string('place_of_birth')->nullable();
      $table->enum('gender', ['male', 'female'])->nullable();
      $table->enum('civil_status', ['single', 'married', 'widow', 'separated'])->nullable();
      $table->string('religion')->nullable();
      $table->string('nationality')->nullable();
      $table->integer('dependents')->nullable();
      $table->text('present_address')->nullable();
      $table->text('permanent_address')->nullable();
      $table->string('mobile_no')->nullable();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('members');
  }
};
