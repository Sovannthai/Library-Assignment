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
        $search = $request->input('search');
        $cate_id = $request->input('cate_id');
        $customer_id = $request->input('customer_id');
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $created_by = $request->input('created_by');

        $borrow_reports = BorrowDetail::with('book.catelog')
            ->when($customer_id, function ($query) use ($customer_id) {
                $query->where('customer_id', $customer_id);
            })
            ->when($search, function ($query) use ($search) {
                $query->whereHas('borrow', function ($borrow) use ($search) {
                    $borrow->where('borrow_code', 'LIKE', '%' . $search . '%')
                        ->orWhereHas('customer', function ($customer) use ($search) {
                            $customer->where('name', 'LIKE', '%' . $search . '%');
                        });
                })
                    ->orWhereHas('book', function ($book) use ($search) {
                        $book->where('book_code', 'LIKE', '%' . $search . '%')
                            ->orWhereHas('catelog', function ($query) use ($search) {
                                $query->where('cate_name', 'LIKE', '%' . $search . '%');
                            });
                    });
            })
            ->when($cate_id, function ($query) use ($cate_id) {
                $query->whereHas('book', function ($book) use ($cate_id) {
                    $book->where('cate_id', $cate_id);
                });
            })
            ->when($start_date, function ($query) use ($start_date) {
                $query->whereHas('borrow', function ($borrow) use ($start_date) {
                    $borrow->whereDate('borrow_date', '>=', $start_date);
                });
            })
            ->when($end_date, function ($query) use ($end_date) {
                $query->whereHas('borrow', function ($borrow) use ($end_date) {
                    $borrow->whereDate('borrow_date', '<=', $end_date);
                });
            })
            ->when($created_by, function ($query) use ($created_by) {
                $query->whereHas('borrow', function ($borrow) use ($created_by) {
                    $borrow->where('created_by', $created_by);
                });
            })
            ->orderBy('borrow_id', 'desc')
            ->paginate(10);
        $customers = Customer::where('status', 1)->get();
        $Users = User::all();
        $books = Book::where('status', 1)->get();
        $catalogs = Catelog::where('status', 1)->get();
        if ($request->ajax()) {
            $view = view('backends.report._table_borrow_report', compact('borrow_reports', 'customers', 'catalogs', 'books','Users'))->render();
            return response()->json([
                'view' => $view
            ]);
        }
        return view('backends.report.borrow_report', compact('borrow_reports', 'customers', 'catalogs', 'books','Users'));
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
