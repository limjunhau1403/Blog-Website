<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@gmail.com',
            'password' => Hash::make('123'),
            'is_admin' => false,
        ]);

        User::create([
            'name' => 'Admin_1',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('a1234567'),
            'is_admin' => true,
        ]);
    }
}
