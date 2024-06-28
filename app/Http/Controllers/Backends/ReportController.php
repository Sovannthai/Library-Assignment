<?php

namespace App\Http\Controllers\Backends;

use App\Models\Book;
use App\Models\User;
use App\Models\Borrow;
use App\Models\Catelog;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BorrowDetail;
use App\Models\CustomerType;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        if (!auth()->user()->can('view.borrow_report')) {
            abort(403, 'Unauthorized action.');
        }
        $filterValue = $request->input('filter');
        $cateId = $request->input('cate_id');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $borrows = BorrowDetail::query();
        $customers = Customer::where('status', 1)->get();
        $Users = User::all();
        $books = Book::where('status', 1)->get();

        if ($request->filled('customer_id')) {
            $borrows->where('customer_id', $request->customer_id);
        }
        if ($request->filled('created_by')) {
            $borrows->where('created_by', $request->created_by);
        }
        if ($startDate && $endDate) {
            $endDate = date('Y-m-d', strtotime($endDate . ' +1 day'));

            $borrows->whereDate('created_at', '>=', $startDate)
                ->whereDate('created_at', '<=', $endDate);
        }
        if ($filterValue !== null) {
            $borrows->where('is_return', $filterValue);
        }
        if ($cateId !== null) {
            $borrows->whereHas('book', function ($query) use ($cateId) {
                $query->where('cate_id', $cateId);
            });
        }

        $borrow_reports = $borrows->latest()->get();
        $catelogs = Catelog::where('status', 1)->get();
        return view('backends.report.borrow_report', compact('borrow_reports', 'customers', 'catelogs', 'books', 'filterValue', 'cateId', 'Users', 'request'));
    }

    public function book_report(Request $request)
    {
        if (!auth()->user()->can('view.book_report')) {
            abort(403, 'Unauthorized action.');
        }
        // $books = Book::query();
        $catelogs = Catelog::all();
        $librarains = User::all();

        // if ($request->filled('cate_id')) {
        //     $books->where('cate_id', $request->cate_id);
        // }
        // if ($request->filled('created_by')) {
        //     $books->where('created_by', $request->created_by);
        // }
        // $books = $books->where('status', 1)->get();
        $book_borrows = BorrowDetail::all();
        return view('backends.report.book_report', compact('book_borrows', 'catelogs', 'librarains'));
    }
    // public function customerReport()
    // {
    //     $reports = DB::table('borrows')
    //         ->join('books', 'borrows.book_id', '=', 'books.id')
    //         ->select('borrows.customer_id', 'books.id as book_id', 'books.book_code', 'books.description')
    //         ->where('borrows.customer_id')
    //         ->get();
    //     dd($reports);
    //     return view('backends.report.customer', compact('reports'));
    // }
    public function customer_report(Request $request)
    {
        if (!auth()->user()->can('view.customer_report')) {
            abort(403, 'Unauthorized action.');
        }
        $catelogs = Catelog::all();
        $customer_types = CustomerType::all();
        $librarains = User::all();
        $customers = Customer::query();
        if ($request->filled('created_by')) {
            $customers->where('created_by', $request->created_by);
        }
        if ($request->filled('customer_type_id')) {
            $customers->where('customer_type_id', $request->customer_type_id);
        }
        $customers = $customers->where('status', 1)->get();
        return view('backends.report.customer_report', compact('catelogs', 'librarains', 'customers', 'customer_types'));
    }
}
