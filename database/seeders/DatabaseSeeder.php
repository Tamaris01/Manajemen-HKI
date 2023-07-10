<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        Admin::create([
            "id" => 1234567890,
            "name" => "Admin sentra HKI",
            "username" => "adminku",
            "email" => "adminku@gmail.com",
            "password" => Hash::make("adminku"),
        ]);
        User::create([
            "id" => 4342211050,
            "name" => "Tamaris",
            "username" => "Tamaris.Roulina",
            "email" => "tamarissilitonga@gmail.com",
            "password" => Hash::make("tama123"),
        ]);
    }
}
