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
                    <th class="px-4 py-2">ISBN</th>
                    <th class="px-4 py-2">Publishing Year</th>
                    <th class="px-4 py-2">Added at</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($books as $book)
                <tr>
                    <td class="border px-4 py-2">{{ $book->title }}</td>
                    <td class="border px-4 py-2">{{ $book->author }}</td>
                    <td class="border px-4 py-2">{{ $book->readings()->count() }}</td>
                    <td class="border px-4 py-2">{{ $book->isbn }}</td>
                    <td class="border px-4 py-2">{{ $book->publishing_year}}</td>
                    <td class="border px-4 py-2">{{ $book->created_at }}</td>

                </tr>
                @endforeach
            </tbody>
        </table>
        <br>
        <br>
        <div class="pagination">
            {{ $books->links()}}
        </div>
        <button id="openDialogBtn" class="bg-green-500 text-white my-4 p-2 rounded-md">Export as JSON</button>
        <dialog id="confirmDialog" class="rounded-lg p-5 bg-white shadow-xl">
            <h2 class="text-xl font-semibold">Export as JSON</h2>
            <p class="mt-2">This will pull all data from <code>books</code> table and export it as a JSON</p>
            <form method="dialog" class="mt-4 flex justify-end space-x-2">
                <button type="button" value="cancel" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400 transition duration-300">
                    Cancel
                </button>
                <a class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600 transition duration-300" href="/export-json" onclick="exportTasks(event.target);">
                    Export
                </a>
            </form>
        </dialog>
    </div>
</div>
<script>
    // Get the dialog element and the button elements
    var dialog = document.getElementById('confirmDialog');
    var openDialogBtn = document.getElementById('openDialogBtn');
    var confirmBtn = document.getElementById('confirmBtn');

    // Event listener to open the dialog
    openDialogBtn.addEventListener('click', function() {
        dialog.showModal(); // Use showModal() to make it modal
    });

    document.querySelector('button[value="cancel"]').addEventListener('click', () => {
        dialog.close();
    });

    function exportTasks(_this) {
        let _url = $(_this).data('href');
        window.location.href = _url;
        dialog.close();
    }
</script>
@endsection