<?php

namespace Database\Seeders;

use App\Models\Product;
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

        Product::create([
            'article' => 'A1',
            'name' => 'Зефир',
            'data' => json_encode(['color' => 'red', 'size' => 10]),
        ]);
        Product::create([
            'article' => 'B1',
            'name' => 'Мармелад',
            'data' => json_encode(['color' => 'blue', 'size' => 20]),
        ]);
        Product::create([
            'article' => 'C1',
            'name' => 'Шоколад',
            'status' => 'unavailable',
            'data' => json_encode(['color' => 'green', 'size' => 30]),
        ]);
    }
}
