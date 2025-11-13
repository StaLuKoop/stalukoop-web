<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void
  {
    Schema::create('parent_info', function (Blueprint $table) {
      $table->uuid('id')->primary();
      $table->uuid('mother')->nullable();
      $table->uuid('father')->nullable();
      $table->timestamps();

      $table->foreign('mother')->references('id')->on('mother_info')->nullOnDelete();
      $table->foreign('father')->references('id')->on('father_info')->nullOnDelete();
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('parent_info');
  }
};
