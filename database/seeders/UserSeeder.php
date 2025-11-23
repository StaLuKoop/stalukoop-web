<?php

namespace Database\Seeders;

use App\Models\Member;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $users = [
      [
        'name' => 'Daniel Vasquez',
        'email' => 'daniel@gmail.com',
        'password' => 'Daniel@123',
        'membership_status' => 'pending',
      ],
      [
        'name' => 'Daniel Vasquez',
        'email' => 'danielvictorv.vasquez18@gmail.com',
        'password' => 'Daniel@123',
        'membership_status' => 'pending',
      ],
      [
        'name' => 'Daniel Vasquez',
        'email' => 'vasquez_danielvictor@plpasig.edu.ph',
        'password' => 'Daniel@123',
        'membership_status' => 'regular',
      ],
      [
        'name' => 'Nicole Pizarro',
        'email' => 'nicolepizarro41@gmail.com',
        'password' => 'KahitAno@123',
        'membership_status' => 'regular',
      ],
      [
        'name' => 'Juan Dela Cruz',
        'email' => 'juan@gmail.com',
        'password' => 'Juan@123',
        'membership_status' => 'regular',
      ],
      [
        'name' => 'Ana Reyes',
        'email' => 'ana@gmail.com',
        'password' => 'Ana@123',
        'membership_status' => 'pending',
      ],
      [
        'name' => 'Pedro Garcia',
        'email' => 'pedro@gmail.com',
        'password' => 'Pedro@123',
        'membership_status' => 'regular',
      ],
    ];

    foreach ($users as $userData) {
      $user = User::create([
        'name' => $userData['name'],
        'email' => $userData['email'],
        'password' => Hash::make($userData['password']),
        'role' => 'member',
        'email_verified_at' => now(),
      ]);

      Member::create([
        'user_id' => $user->id,
        'membership_status' => $userData['membership_status'],
      ]);
    }
  }
}
