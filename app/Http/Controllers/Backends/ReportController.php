<?php

namespace App\Http\Controllers\Backends;

use App\Models\Book;
use App\Models\User;
use App\Models\Borrow;
use App\Models\Catelog;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $filterValue = $request->input('filter');
        $cateId = $request->input('cate_id');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $borrows = Borrow::query();
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

            $borrows->whereDate('borrow_date', '>=', $startDate)
                ->whereDate('borrow_date', '<=', $endDate);
        }
        if ($filterValue !== null) {
            $borrows->where('is_return', $filterValue);
        }
        if ($cateId !== null) {
            $borrows->whereHas('book', function ($query) use ($cateId) {
                $query->where('cate_id', $cateId);
            });
        }
        // if ($request->filled('catelog_id')) {
        //     $borrows->where('catelog_id', $request->catelog_id);
        // }
        // if ($request->filled('book_id')) {
        //     $borrows->where('book_id', $request->book_id);
        // }
        $borrows = $borrows->get();
        $catelogs = Catelog::where('status', 1)->get();
        return view('backends.report.borrow_report', compact('borrows', 'customers', 'catelogs', 'books', 'filterValue', 'cateId', 'Users', 'request'));
    }
    public function book_report(Request $request)
    {
        $books = Book::query();
        $catelogs = Catelog::all();
        $librarains = User::all();

        if ($request->filled('cate_id')) {
            $books->where('cate_id', $request->cate_id);
        }
        if ($request->filled('created_by')) {
            $books->where('created_by', $request->created_by);
        }
        $books = $books->where('status', 1)->get();
        return view('backends.report.book_report', compact('books', 'catelogs', 'librarains'));
    }
    public function customer_report(Request $request)
    {
        $books = Book::query();
        $catelogs = Catelog::all();
        $librarains = User::all();

        if ($request->filled('cate_id')) {
            $books->where('cate_id', $request->cate_id);
        }
        if ($request->filled('created_by')) {
            $books->where('created_by', $request->created_by);
        }
        $books = $books->where('status', 1)->get();
        return view('backends.report.customer_report', compact('books', 'catelogs', 'librarains'));
    }
}
