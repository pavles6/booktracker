<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Reading;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $book_count = Book::count();
        $user_count = User::count();
        $reading_count = Reading::count();

        return view('dashboard', [
            'book_count' => $book_count,
            'user_count' => $user_count,
            'reading_count' => $reading_count,
            "books" => Book::query()->paginate(10),
        ]);
    }
}
