<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Book;
use App\Models\Borrow;
use App\Models\BorrowDetail;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

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
    public function index(Request $request)
    {
        // $filter = $request->input('filter', 'day');
        // $start = Carbon::now()->startOfDay();
        // $end = Carbon::now()->endOfDay();
        // switch ($filter) {
        //     case 'week':
        //         $start = Carbon::now()->startOfWeek();
        //         $end = Carbon::now()->endOfWeek();
        //         break;
        //     case 'month':
        //         $start = Carbon::now()->startOfMonth();
        //         $end = Carbon::now()->endOfMonth();
        //         break;
        //     case 'year':
        //         $start = Carbon::now()->startOfYear();
        //         $end = Carbon::now()->endOfYear();
        //         break;
        // }
        // $borrows = Borrow::whereBetween('created_at', [$start, $end])->count();
        // $customer = Customer::whereBetween('created_at', [$start, $end])->count();
        // $deposit_amount = Borrow::where('is_return', '1')
        //     ->whereBetween('created_at', [$start, $end])
        //     ->sum('deposit_amount');
        // $find_amount = BorrowDetail::where('is_return', '0')
        //     ->whereBetween('created_at', [$start, $end])
        //     ->sum('find_amount');
        $topBooks = DB::table('borrow_details')
            ->select('book_id', DB::raw('count(*) as borrow_count'))
            ->groupBy('book_id')
            ->orderBy('borrow_count', 'desc')
            ->take(5)
            ->get();
        $topBooks = $topBooks->map(function ($book) {
            $bookDetails = DB::table('books')->find($book->book_id);
            $book->book_code = $bookDetails->book_code;
            $book->description = $bookDetails->description;
            return $book;
        });
        $currentYear = Carbon::now()->year;

        $monthlyData = DB::table('borrow_details')
            ->select(DB::raw('MONTH(created_at) as month'), DB::raw('count(*) as borrow_count'))
            ->whereYear('created_at', $currentYear)
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy(DB::raw('MONTH(created_at)'))
            ->pluck('borrow_count', 'month');

        $monthlyData = $monthlyData->toArray();
        $allMonths = array_fill(1, 12, 0);
        $monthlyData = array_replace($allMonths, $monthlyData);
        $borrow_books = BorrowDetail::where('is_return','1')->count('book_id');
        $customer = Customer::count();
        $deposit_amount = Borrow::where('is_return', '1')->sum('deposit_amount');
        $find_amount = BorrowDetail::where('is_return', '0')->sum('find_amount');
        return view('backends.index', compact('borrow_books', 'customer', 'deposit_amount', 'find_amount', 'topBooks', 'monthlyData'));
    }
}
