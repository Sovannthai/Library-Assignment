<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Book;
use App\Models\User;
use App\Models\Borrow;
use App\Models\Catelog;
use App\Models\Customer;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $borrowedBooks = Borrow::select('book_id')->get();
        $bookCounts = [];
        foreach ($borrowedBooks as $borrow) {
            $bookIds = $borrow->book_id;
            foreach ($bookIds as $bookId) {
                if (isset($bookCounts[$bookId])) {
                    $bookCounts[$bookId]++;
                } else {
                    $bookCounts[$bookId] = 1;
                }
            }
        }
        arsort($bookCounts);
        $topBookIds = array_slice(array_keys($bookCounts), 0, 5, true);

        $topBooks = Book::whereIn('id', $topBookIds)
            ->get(['id', 'book_code', 'description'])
            ->map(function ($book) use ($bookCounts) {
                return [
                    'book_code' => $book->book_code,
                    'description' => $book->description,
                    'borrow_count' => $bookCounts[$book->id],
                ];
            })
            ->sortByDesc('borrow_count')
            ->values();

        $currentYear = Carbon::now()->year;

        $borrowedBooksByMonth = Borrow::selectRaw('MONTH(created_at) as month, SUM(JSON_LENGTH(book_id)) as borrow_count')
            ->whereYear('created_at', $currentYear)
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->pluck('borrow_count', 'month')
            ->toArray();

        // Ensure all months are present in the array
        $monthlyData = array_fill(1, 12, 0);
        foreach ($borrowedBooksByMonth as $month => $count) {
            $monthlyData[$month] = $count;
        }
        $books = Book::count();
        $users = User::count();
        $customer = Customer::count();
        $borrows = Borrow::where('is_return', '1')->get();
        $totalBookIds = [];
        foreach ($borrows as $borrow) {
            $totalBookIds = array_merge($totalBookIds, $borrow->book_id);
        }
        $totalBookCount = count($totalBookIds);
        $catelogs = Catelog::where('status', 1)->count();
        $deposte_amount = Borrow::where('is_return', '1')->sum('deposit_amount');
        $find_amount = Borrow::where('is_return', '0')->sum('find_amount');
        return view('backends.index', compact('books', 'users', 'customer', 'borrows', 'deposte_amount', 'find_amount', 'totalBookCount', 'catelogs', 'topBooks', 'monthlyData'));
    }
}
