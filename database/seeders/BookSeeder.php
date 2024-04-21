<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $books = fopen(base_path("database/data/books_data.csv"), "r");

        $firstRow = true;

        while (($data = fgetcsv($books, 2000, ",")) !== FALSE) {
            if ($firstRow) {
                $firstRow = false;
                continue;
            }

            DB::table("books")->insert([
                "title" => $data[0],
                "author" => $data[1],
                "isbn" => $data[2],
                "publishing_year" => $data[3],
                "created_at" => now(),
                "updated_at" => now(),
            ]);
            $firstRow = false;
        }

        fclose($books);
    }
}
