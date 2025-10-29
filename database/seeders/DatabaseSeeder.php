<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Message;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Http;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       
        User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('Admin@123'),
                'role' => '1',
                'phone' => '1111111111',
                'status' => 1,
            ]
        );
     


// Create 30 Members
for ($i = 1; $i <= 30; $i++) {
    User::create([
        'name' => 'Member ' . $i,
        'email' => 'member' . $i . '@gmail.com',
        'phone' => '900000' . str_pad($i, 4, '0', STR_PAD_LEFT), // unique phone
        'password' => Hash::make('12345678'),
        'role' => 3, // Member
        'status' => 1,
    ]);
}
    
    }
}
