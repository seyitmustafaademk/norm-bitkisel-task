<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
                'firstname' => 'Super',
                'lastname' => 'Admin',
                'birthday' => '1990-01-01',
                'username' => 'superadmin',
                'email' => 'super.admin@mail.com',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ],
            [
                'firstname' => 'John',
                'lastname' => 'Doe',
                'birthday' => '1990-01-01',
                'username' => 'johndoe',
                'email' => 'demo@user.com',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
            ]
        ];

        if (User::count() > 0) {
            return;
        }

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
