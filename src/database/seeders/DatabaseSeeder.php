<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([           //TODO:: Добавить, чтобы при создании пользователя ему администратор сразу выдавал роль, также нужен круд для пользователей, чтобы администратор могу взаимодействовать с их данными
            'name' => 'admin',
            'email' => 'admin@mail.ru',
            'password' => 'admin'
        ]);

        User::factory()->create([
            'name' => 'operator',
            'email' => 'operator@mail.ru',
            'password' => 'operator'
        ]);

        User::factory()->create([
            'name' => 'manager',
            'email' => 'manager@mail.ru',
            'password' => 'manager'
        ]);
    }
}
