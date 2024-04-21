<?php

namespace App\Http\Controllers;

use App\Models\Book;


class JSONExportController extends Controller
{
    public function export()
    {
        $fileName = 'books-export-' . date('m/d/Y_h_i_s', time()) . '.json';
        $books = Book::all();

        $headers = array(
            "Content-type"        => "application/json",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $serializable_books = [];

        foreach ($books as $book) {
            array_push(
                $serializable_books,
                [
                    'Title' => $book->title,
                    'Author' => $book->author,
                    'Readings' => $book->readings()->count(),
                    'ISBN' => $book->isbn,
                    'Publishing Year' => $book->publishing_year,
                    'Added at' => $book->created_at,
                ]
            );
        }

        $callback = function () use ($serializable_books) {
            $file = fopen('php://output', 'w');

            file_put_contents('php://output', json_encode($serializable_books, JSON_PRETTY_PRINT));

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
