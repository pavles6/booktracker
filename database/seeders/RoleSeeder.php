<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dt = Carbon::now();
        $dateNow = $dt->toDateTimeString();

        DB::table("roles")->insert([
            'name' => 'admin',
            'created_at' => $dateNow,
            'updated_at' => $dateNow
        ]);
    }
}
