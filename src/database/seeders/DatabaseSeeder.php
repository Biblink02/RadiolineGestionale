<?php

namespace Database\Seeders;

use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        if (env('APP_ENV') === 'local') {
            User::factory()->create([
                'name' => 'a',
                'email' => 'alby.bot.24@gmail.com',
                'password' => '$2y$12$HP/jLvByNzguB4wJr9YgBurD1zm0TA8v9YDv8XdF14bFwp/bPGCdu',
            ]);
            User::factory()->create([
                'name' => 'a',
                'email' => 'a@a',
                'password' => '$2y$12$HP/jLvByNzguB4wJr9YgBurD1zm0TA8v9YDv8XdF14bFwp/bPGCdu',
            ]);
        }
    }
}
