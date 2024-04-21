@extends('layouts.app')

@section('content')
<div class="justify-center">
    <div class="w-full bg-white p-6 rounded-lg">
        <div class="grid grid-cols-3 gap-4">
            <div class="max-w-sm rounded overflow-hidden shadow-lg bg-white m-4">
                <div class="px-6 py-4">
                    <div class="font-bold text-xl mb-2">Books</div>
                    <p class="text-gray-700 text-base">
                        Total: <strong>{{ $book_count }}</strong>
                    </p>
                </div>
            </div>
            <div class="max-w-sm rounded overflow-hidden shadow-lg bg-white m-4">
                <div class="px-6 py-4">
                    <div class="font-bold text-xl mb-2">Readings</div>
                    <p class="text-gray-700 text-base">
                        Total: <strong>{{ $reading_count }}</strong>
                    </p>
                </div>
            </div>
            <div class="max-w-sm rounded overflow-hidden shadow-lg bg-white m-4">
                <div class="px-6 py-4">
                    <div class="font-bold text-xl mb-2">Users</div>
                    <p class="text-gray-700 text-base">
                        Total: <strong>{{ $user_count }}</strong>
                    </p>
                </div>
            </div>
        </div>

        <hr class="my-4" />

        <p class="text-2xl">Books overview</p>
        <hr class="my-4" />
        <table class="table-auto w-full">
            <thead class="">
                <tr>
                    <th class="px-4 py-2">Title</th>
                    <th class="px-4 py-2">Author</th>
                    <th class="px-4 py-2">Readings</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($books as $book)
                <tr>
                    <td class="border px-4 py-2">{{ $book->title }}</td>
                    <td class="border px-4 py-2">{{ $book->author }}</td>
                    <td class="border px-4 py-2">{{ $book->readings()->count() }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <br>
        <br>
        <div class="pagination">
            {{ $books->links()}}
        </div>
    </div>
</div>
@endsection