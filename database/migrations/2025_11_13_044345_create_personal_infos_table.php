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
    Schema::create('personal_info', function (Blueprint $table) {
      $table->uuid('id')->primary();

      $table->string('firstname');
      $table->string('middlename')->nullable();
      $table->string('lastname');
      $table->enum('gender', ['Male', 'Female', 'Other']);
      $table->enum('civil_status', ['Single', 'Married', 'Widowed', 'Separated', 'Other']);
      $table->string('nationality')->nullable();
      $table->integer('no_of_dependents')->nullable();
      $table->date('date_of_birth')->nullable();
      $table->string('place_of_birth')->nullable();
      $table->string('religion')->nullable();

      // Foreign UUID references
      $table->uuid('parent_info')->nullable();
      $table->uuid('spouse_info')->nullable();
      $table->uuid('contact_info')->nullable();
      $table->uuid('gov_id')->nullable();
      $table->uuid('monthly_expenses')->nullable();
      $table->uuid('employment_info')->nullable();
      $table->uuid('home_addresses')->nullable();
      $table->uuid('slpmc_relative')->nullable();
      $table->uuid('private_property')->nullable();

      $table->timestamps();

      // Foreign key constraints
      $table->foreign('parent_info')->references('id')->on('parent_info')->nullOnDelete();
      $table->foreign('spouse_info')->references('id')->on('spouse_info')->nullOnDelete();
      $table->foreign('contact_info')->references('id')->on('contact_info')->nullOnDelete();
      $table->foreign('gov_id')->references('id')->on('gov_id')->nullOnDelete();
      $table->foreign('monthly_expenses')->references('id')->on('monthly_expenses')->nullOnDelete();
      $table->foreign('employment_info')->references('id')->on('employment_info')->nullOnDelete();
      $table->foreign('home_addresses')->references('id')->on('home_addresses')->nullOnDelete();
      $table->foreign('slpmc_relative')->references('id')->on('slpmc_relatives')->nullOnDelete();
      $table->foreign('private_property')->references('id')->on('private_property')->nullOnDelete();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('personal_info');
  }
};
