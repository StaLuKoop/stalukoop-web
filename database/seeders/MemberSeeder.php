<?php

namespace Database\Seeders;

use App\Models\Member;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $members = [
            [
                'name' => 'Daniel V. Vasquez',
                'email' => 'vasquez_danielvictor@plpasig.edu.ph',
                'password' => 'Daniel@456',
                'membership_status' => 'pending',
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

        foreach ($members as $memberData) {
            $user = User::create([
                'name' => $memberData['name'],
                'email' => $memberData['email'],
                'password' => Hash::make($memberData['password']),
                'role' => 'member',
                'email_verified_at' => now(),
            ]);

            Member::create([
                'user_id' => $user->id,
                'membership_status' => $memberData['membership_status'],
            ]);
        }
    }
}
