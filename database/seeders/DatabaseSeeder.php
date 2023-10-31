<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // AAAAaaaa
        User::create([
            'name' => 'admin',
            'email' => 'admin@mail.ru',
            'password' => '$2y$10$1qkTTjdEGGMpSpVgkr0BkOc/em3fMqbNoXMGJ2HqU6nIn23JxwcGG',
            'is_admin' => 'true',
        ]);
        User::create([
            'name' => 'user',
            'email' => 'user@mail.ru',
            'password' => '$2y$10$1qkTTjdEGGMpSpVgkr0BkOc/em3fMqbNoXMGJ2HqU6nIn23JxwcGG',
        ]);
    }
}
