@extends('layouts.app')

@section('content')
<div class="flex flex-col bg-white p-6 rounded-lg">
    <div class="w-fit grid grid-cols-4 gap-4">
        @foreach ($books as $book)
        <div class="max-w-sm rounded overflow-hidden shadow-lg bg-white m-4">
            <div class="px-6 py-4">
                <div class="font-bold text-xl mb-2">{{ $book->title }}</div>
                <p class="text-gray-700 text-base">
                    Author: <strong>{{ $book->author }}</strong>
                </p>
                <p class="text-gray-700 text-base">
                    Year: <strong>{{ $book->publishing_year }}</strong>
                </p>
                <p class="text-gray-700 text-base">
                    Genre: <strong>{{ $book->genre }}</strong>
                </p>
                <p class="text-gray-700 text-base">
                    ISBN: <strong>{{ $book->isbn }}</strong>
                </p>
                <hr class="my-4 w-full" />
                <p class="text-gray-700 text-base">
                    Readers: <strong>{{ $book->readings()->count() ?? "0" }}</strong>
                </p>
                @auth
                @if ($book->readings()->whereIn('user_id', [auth()->id()])->get()->count() == 0)
                <form action="{{ route('books.mark-as-reading', $book->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="mt-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Mark as Currently Reading
                    </button>
                </form>
                @else
                <form action="{{ route('books.unmark-as-reading', $book->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="mt-4 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                        Mark as Not Reading
                    </button>
                </form>
                @endif
                @endauth
            </div>
        </div>
        @endforeach
    </div>
    <div class="">
        {{ $books->links()}}
    </div>
</div>
@endsection