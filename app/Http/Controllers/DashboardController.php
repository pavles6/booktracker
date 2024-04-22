<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Reading;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $book_count = Book::count();
        $user_count = User::count();
        $reading_count = Reading::count();

        return view('admin', [
            'book_count' => $book_count,
            'user_count' => $user_count,
            'reading_count' => $reading_count,
            "books" => Book::query()->paginate(10),
            "users" => User::leftJoin('readings', 'users.id', '=', 'readings.user_id')
                ->select('users.name', 'users.username', 'email', DB::raw('count(readings.id) as readings'), 'users.created_at')
                ->groupBy('users.id', 'users.name')
                ->orderBy('readings', 'desc')
                ->paginate(10),
            "userChartData" => $this->getUserChartData(),
            "booksChartData" => $this->getReadingsByBookGenreForChart(),
        ]);
    }

    private function getUserChartData()
    {
        $usersPerDay = User::select(DB::raw('DATE(created_at) as registration_date'), DB::raw('count(*) as users_count'))
            ->where('created_at', '>=', now()->subDays(120))
            ->groupBy('registration_date')
            ->orderBy('registration_date', 'asc')
            ->get();

        // Initialize arrays for labels (dates) and data (user counts)
        $labels = [];
        $data = [];

        // Populate the labels and data arrays
        foreach ($usersPerDay as $day) {
            $labels[] = $day->registration_date; // Add the date to the labels array
            $data[] = $day->users_count; // Add the count of users to the data array
        }



        // Output the arrays (for example purposes, you might use these arrays to feed a chart library)
        return [
            'labels' => $labels,
            'data' => $data,
        ];
    }

    public function getReadingsByBookGenreForChart()
    {
        $readingsByGenre = Reading::join('books', 'readings.book_id', '=', 'books.id')
            ->select('books.genre', DB::raw('count(readings.id) as total_readings'))
            ->groupBy('books.genre')
            ->get();

        // Prepare data for Chart.js
        $labels = [];
        $data = [];

        foreach ($readingsByGenre as $genre) {
            $labels[] = $genre->genre; // The genre of the books
            $data[] = $genre->total_readings; // The count of readings per genre
        }

        // Format for Chart.js
        $chartData = [
            'labels' => $labels,
            'data' => [
                [
                    'data' => $data,
                    'backgroundColor' => $this->generateColors(count($data)), // Dynamic colors for each genre
                    'hoverOffset' => 4,
                    'label' => "Readings",
                ]
            ]
        ];

        return $chartData;
    }

    private function generateColors($count)
    {
        $colors = [];
        for ($i = 0; $i < $count; $i++) {
            $colors[] = '#' . substr(md5(rand()), 0, 6); // Generate random colors
        }
        return $colors;
    }
}
