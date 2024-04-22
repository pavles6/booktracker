<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class JSONExportController extends Controller
{
    public function exportBooks()
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
                    'Genre' => $book->genre,
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

    public function exportUsers()
    {
        $fileName = 'users-export-' . date('m/d/Y_h_i_s', time()) . '.json';
        $users = User::leftJoin('readings', 'users.id', '=', 'readings.user_id')
            ->select('users.name', 'users.username', 'email', DB::raw('count(readings.id) as readings'), 'users.created_at')
            ->groupBy('users.id', 'users.name')
            ->orderBy('readings', 'desc')->get();

        $headers = array(
            "Content-type"        => "application/json",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $serializable_users = [];

        foreach ($users as $user) {
            array_push(
                $serializable_users,
                [
                    'Name' => $user->name,
                    'Username' => $user->username,
                    'Email' => $user->email,
                    'Total Readings' => $user->readings,
                    'Registered At' => $user->created_at,
                ]
            );
        }

        $callback = function () use ($serializable_users) {
            $file = fopen('php://output', 'w');

            file_put_contents('php://output', json_encode($serializable_users, JSON_PRETTY_PRINT));

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
