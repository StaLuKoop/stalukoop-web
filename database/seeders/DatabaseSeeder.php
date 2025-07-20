<?php

namespace Database\Seeders;

use App\Models\Inquiry;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Member;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   */
  public function run(): void
  {
    $admin = User::factory()->create([
      'name' => 'Administrator',
      'email' => 'admin@gmail.com',
      'password' => Hash::make('Admin@123'),
      'role' => 'admin',
    ]);

    Member::create([
      'user_id' => $admin->id,
      'membership_status' => 'pending',
    ]);

    $daniel = User::factory()->create([
      'name' => 'Daniel Vasquez',
      'email' => 'daniel@gmail.com',
      'password' => Hash::make('Daniel@123'),
      'role' => 'member',
    ]);

    Member::create([
      'user_id' => $daniel->id,
      'membership_status' => 'pending',
    ]);

    User::factory(10)->create()->each(function ($user) {
      Member::create([
        'user_id' => $user->id,
        'membership_status' => 'pending',
      ]);
    });

    Inquiry::factory(30)->create();
  }
}
