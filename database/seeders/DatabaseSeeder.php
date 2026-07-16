<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'name' => 'Admin Anauri',
            'username' => 'admin',
            'email' => 'test@example.com',
            'password' => Hash::make('admin'),
            'user_role' => 'admin'
        ]);
    }
}
