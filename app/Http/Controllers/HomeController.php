<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrow;
use App\Models\Catelog;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Auth\Middleware\Authorize;
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
    public function index()
    {
        $books = Book::count();
        $users = User::count();
        $customer = Customer::count();
        $borrows = Borrow::where('is_return', '1')->get();
        $totalBookIds = [];
        foreach ($borrows as $borrow) {
            $totalBookIds = array_merge($totalBookIds, $borrow->book_id);
        }
        $totalBookCount = count($totalBookIds);
        $catelogs = Catelog::where('status',1)->count();
        $deposte_amount = Borrow::where('is_return', '1')->sum('deposit_amount');
        $find_amount = Borrow::where('is_return', '0')->sum('find_amount');
        return view('backends.index', compact('books', 'users', 'customer', 'borrows', 'deposte_amount', 'find_amount','totalBookCount','catelogs'));
    }
}
