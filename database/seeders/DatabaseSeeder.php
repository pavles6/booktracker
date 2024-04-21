<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $book_seeder = new BookSeeder();

        $book_seeder->run();

        $role_seeder = new RoleSeeder();

        $role_seeder->run();
    }
}
