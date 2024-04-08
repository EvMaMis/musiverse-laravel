<?php

namespace Database\Seeders;

use App\Models\Artist;
use App\Models\Genre;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        Tag::factory(20)->create();
        Genre::factory(10)->create();
        Artist::factory(15)->create();

        Permission::create(['name' => 'Suggest', 'description' => 'Permission to suggest tracks, tags, genres, artists. To be shown in an app suggested elements should be confirmed with someone having Confirm permission.']);
//        Permission::create(['name' => 'Show', 'description' => 'Permission to see tracks, tags, genres, artists. Can change, add or delete anything, but can see aforementioned elements and have an access to admin panel']);
        Permission::create(['name' => 'Confirm', 'description' => 'Permission to publish and unpublish suggested tracks, tags, genres, artists.']);
        Permission::create(['name' => 'Add', 'description' => 'Permission to add tracks, tags, genres, artists. Doesn\'t need any confirmation, already published on create']);
        Permission::create(['name' => 'Edit', 'description' => 'Permission to edit tracks, tags, genres, artists.']);
        Permission::create(['name' => 'Delete', 'description' => 'Permission to delete tracks, tags, genres, artists.']);
        Permission::create(['name' => 'Manage roles', 'description' => 'USE WITH CAUTION! Permission to add, edit, remove roles and users. Don\'t add this permission to any role, unless you want another super-user (which already exists as a role)']);


        Role::create(['name' => 'User']);
        Role::create(['name' => 'Super-Admin'])->syncPermissions([Permission::all()->pluck('name')->except('0')]);

        $user = User::create(['name' => 'Admin', 'email' => 'admin@gmail.com', 'password' => Hash::make('12345678')]);
        $user->assignRole('Super-Admin');
    }
}
