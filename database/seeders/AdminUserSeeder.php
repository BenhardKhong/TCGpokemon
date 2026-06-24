<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        if(!User::where('email','admin@example.com')->exists()){
            User::create([
                'username' => 'admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('secret'),
                'wallet' => 0,
                'is_admin' => true
            ]);
        }
    }
}
