<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [];

        for ($i = 1; $i <= 25; $i++) {
            $name = "User $i";
            $username = "username$i";
            $password = "password$i";
            $email = "user$i@example.com";

            // Create the user array
            $user = [
                'name' => $name,
                'username' => $username,
                'password' => password_hash($password, PASSWORD_DEFAULT), // Hash the password
                'email' => $email
            ];

            // Add the user to the users array
            $users[] = $user;
        }

        // Insert the users into the database
        DB::table('users')->insert($users);
    }
}
