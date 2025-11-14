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
    Schema::create('personal_infos', function (Blueprint $table) {
      $table->uuid('id')->primary();
      $table->string('firstname');
      $table->string('middlename')->nullable();
      $table->string('lastname');
      $table->string('gender');
      $table->string('civil_status');
      $table->string('nationality');
      $table->integer('no_of_dependents')->nullable();
      $table->date('date_of_birth')->nullable();
      $table->string('place_of_birth')->nullable();
      $table->string('religion')->nullable();

      $table->uuid('parent_info')->nullable();
      $table->uuid('spouse_info')->nullable();
      $table->uuid('contact_info')->nullable();
      $table->uuid('gov_id')->nullable();
      $table->uuid('monthly_expenses')->nullable();
      $table->uuid('employment_info')->nullable();
      $table->uuid('home_addresses')->nullable();
      $table->uuid('slpmc_relative')->nullable();
      $table->uuid('private_property')->nullable();
      $table->uuid('membership_payment')->nullable();

      $table->timestamps();

      $table->foreign('parent_info')->references('id')->on('parent_infos')->nullOnDelete();
      $table->foreign('spouse_info')->references('id')->on('spouse_infos')->nullOnDelete();
      $table->foreign('contact_info')->references('id')->on('contact_infos')->nullOnDelete();
      $table->foreign('gov_id')->references('id')->on('gov_ids')->nullOnDelete();
      $table->foreign('monthly_expenses')->references('id')->on('monthly_expenses')->nullOnDelete();
      $table->foreign('employment_info')->references('id')->on('employment_infos')->nullOnDelete();
      $table->foreign('home_addresses')->references('id')->on('home_addresses')->nullOnDelete();
      $table->foreign('slpmc_relative')->references('id')->on('slpmc_relatives')->nullOnDelete();
      $table->foreign('private_property')->references('id')->on('private_properties')->nullOnDelete();
      $table->foreign('membership_payment')->references('id')->on('membership_payments')->nullOnDelete();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('personal_infos');
  }
};
