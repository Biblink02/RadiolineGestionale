<?php

namespace Database\Seeders;

use App\Enums\RadioStatusEnum;
use App\Models\Radio;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        if (app()->environment('local')) {
            foreach (['alby.bot.24@gmail.com', 'a@a'] as $email) {
                User::firstOrCreate(['email' => $email], [
                    'name' => 'a',
                    'email_verified_at' => now(),
                    'password' => '$2y$12$HP/jLvByNzguB4wJr9YgBurD1zm0TA8v9YDv8XdF14bFwp/bPGCdu',
                ]);
            }
        }

        $existing = array_fill_keys(Radio::pluck('identifier')->all(), true);
        $data = [];
        $now = now();

        for ($identifier = 1000; $identifier <= 9999; $identifier++) {
            if (isset($existing[$identifier])) {
                continue;
            }

            $data[] = [
                'identifier' => $identifier,
                'status' => ($identifier <= 2999 ? RadioStatusEnum::AVAILABLE : RadioStatusEnum::UNLOANABLE)->value,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        foreach (array_chunk($data, 500) as $radios) {
            // The unique identifier also protects concurrent startup attempts.
            Radio::insertOrIgnore($radios);
        }
    }
}
