<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void
  {
    Schema::create('employment_info', function (Blueprint $table) {
      $table->uuid('id')->primary();
      $table->string('employment_type')->nullable();
      $table->string('employer_or_business_name')->nullable();
      $table->string('employer_or_business_address')->nullable();
      $table->timestamps();
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('employment_info');
  }
};
