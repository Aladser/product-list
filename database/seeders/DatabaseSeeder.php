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
            'password' => '$2y$10$PTy20SmgowBKIDav9AwsBOp5p0a90mWw4FILg5EiNNs79./j4D6lS',
            'is_admin' => 'true',
        ]);
        User::create([
            'name' => 'user',
            'email' => 'user@mail.ru',
            'password' => '$2y$10$PTy20SmgowBKIDav9AwsBOp5p0a90mWw4FILg5EiNNs79./j4D6lS',
        ]);
    }
}
