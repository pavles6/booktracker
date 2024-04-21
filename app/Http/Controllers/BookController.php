<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {

        $books = Book::with('readings')->get();

        return view('welcome', [
            'books' => $books
        ]);
    }
}
