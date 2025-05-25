<?php

namespace Database\Seeders;

use App\Enums\RadioStatusEnum;
use App\Models\Radio;
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
        /*
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



        // Crea le radio con identifier da 1001 a 9999
        $data = [];
        $now = now(); // oppure Carbon::now();

        for ($i = 1001; $i <= 9999; $i++) {
            $data[] = [
                'identifier' => $i,
                'status'     => ($i <= 2999) ? RadioStatusEnum::AVAILABLE : RadioStatusEnum::UNLOANABLE,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        Radio::insert($data);
        */
    }
}
