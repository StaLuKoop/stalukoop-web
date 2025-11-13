<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void
  {
    Schema::create('permanent_home', function (Blueprint $table) {
      $table->uuid('id')->primary();
      $table->string('permanent_home_address');
      $table->enum('housing_status', ['Owned', 'Rented', 'Living with Parents', 'Mortgaged', 'Others']);
      $table->integer('monthly_rent')->nullable();
      $table->integer('months_of_renting')->nullable();
      $table->timestamps();
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('permanent_home');
  }
};
