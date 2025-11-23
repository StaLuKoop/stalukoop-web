<?php

namespace Database\Seeders;

use App\Models\Member;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $admins = [
      [
        'name' => 'Victor Vasquez',
        'email' => 'victor@gmail.com',
        'password' => 'Victor@123',
      ],
      [
        'name' => 'Administrator',
        'email' => 'danielvictorv.vasquez36@gmail.com',
        'password' => 'Daniel@123',
      ],
    ];

    foreach ($admins as $adminData) {
      $user = User::create([
        'name' => $adminData['name'],
        'email' => $adminData['email'],
        'password' => Hash::make($adminData['password']),
        'role' => 'admin',
        'email_verified_at' => now(),
      ]);

      Member::create([
        'user_id' => $user->id,
        'membership_status' => 'regular',
      ]);
    }
  }
}
