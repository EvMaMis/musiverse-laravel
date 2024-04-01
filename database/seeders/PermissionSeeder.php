<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'add roles', 'description' => 'Разрешение на добавление новых ролей']);
        Permission::create(['name' => 'edit roles', 'description' => 'Разрешение на изменение существующих ролей']);
        Permission::create(['name' => 'delete roles', 'description' => 'Разрешение на удаление ролей']);

        Permission::create(['name' => 'add songs', 'description' => 'Разрешение на добавление композиций']);
        Permission::create(['name' => 'edit songs', 'description' => 'Разрешение на изменение композиций']);
        Permission::create(['name' => 'delete songs', 'description' => 'Разрешение на удаление композиций']);

        Permission::create(['name' => 'user', 'description' => 'Авторизованый пользователь, автоматически назначается всем зарегистрированным пользователям']);
    }
}
