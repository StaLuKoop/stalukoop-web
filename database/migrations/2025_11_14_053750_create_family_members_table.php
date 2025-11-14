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
    Schema::create('family_members', function (Blueprint $table) {
      $table->uuid('fam_id')->primary();
      $table->string('name');
      $table->string('gender');
      $table->string('relationship');
      $table->string('marital_status')->nullable();
      $table->string('educational_attainment')->nullable();
      $table->string('occupation')->nullable();
      $table->uuid('client_id');
      $table->timestamps();

      $table->foreign('client_id')->references('id')->on('personal_infos')->cascadeOnDelete();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('family_members');
  }
};
