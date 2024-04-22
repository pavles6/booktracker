<?php

namespace App\Http\Controllers;

use App\Models\Book;

class BookController extends Controller
{
    public function index()
    {

        $books = Book::with('readings')->paginate(20);

        return view('welcome', [
            'books' => $books,
        ]);
    }
}
