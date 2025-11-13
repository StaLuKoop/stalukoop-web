<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void
  {
    Schema::create('spouse_info', function (Blueprint $table) {
      $table->uuid('id')->primary();
      $table->string('firstname');
      $table->string('middlename')->nullable();
      $table->string('lastname');
      $table->string('employer_or_business_name')->nullable();
      $table->string('employer_or_business_address')->nullable();
      $table->timestamps();
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('spouse_info');
  }
};
