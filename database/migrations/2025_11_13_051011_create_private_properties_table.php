<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void
  {
    Schema::create('private_property', function (Blueprint $table) {
      $table->uuid('id')->primary();
      $table->uuid('car_ownership')->nullable();
      $table->uuid('house_and_lot')->nullable();
      $table->timestamps();

      $table->foreign('car_ownership')->references('id')->on('car_ownership')->nullOnDelete();
      $table->foreign('house_and_lot')->references('id')->on('house_and_lot')->nullOnDelete();
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('private_property');
  }
};
