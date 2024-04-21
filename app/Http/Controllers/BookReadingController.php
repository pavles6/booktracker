<?php

namespace App\Http\Controllers;

use App\Models\Book;

class BookReadingController extends Controller
{
    public function store(Book $book)
    {
        $book->readings()->create([
            'user_id' => auth()->id(),
        ]);

        return back();
    }

    public function destroy(Book $book)
    {
        $book->readings()->where('user_id', auth()->id())->delete();

        return back();
    }
}
