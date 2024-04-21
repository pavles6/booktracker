<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booktracker</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-slate-200">
    <nav class="bg-gray-800 h-14 px-4 text-white flex">
        <div class="flex items-center justify-between w-full">
            <h1 class="text-lg font-semibold">
                BookTracker
            </h1>

            <div class="flex divide-x divide-slate-500">
                <ul class="flex justify-between items-center">
                    <a href="/dashboard" class="px-3 py-2 rounded hover:bg-gray-700">Dashboard</a>
                    <a href="/" class="px-3 py-2 rounded hover:bg-gray-700">Home</a>
                </ul>
                @guest
                <ul class="flex justify-between items-center">
                    <a href="/login" class="px-3 py-2 rounded hover:bg-gray-700">Login</a>
                    <a href="{{route('register')}}" class="px-3 py-2 rounded hover:bg-gray-700">Register</a>
                </ul>
                @endguest
                @auth
                <ul class="flex justify-between items-center">
                    <p class="px-3 py-2 rounded">Welcome, {{auth()->user()->name}}</p>
                    <form action="{{route('logout')}}" method="post">
                        @csrf
                        <button type="submit" class="px-3 py-2 rounded hover:bg-gray-700">Logout</button>
                    </form>
                </ul>
                @endauth
            </div>
        </div>
    </nav>
    <div class="p-8">
        @yield('content')
    </div>
</body>

</html>