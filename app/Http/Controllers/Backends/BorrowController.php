<?php

namespace App\Http\Controllers\Backends;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Borrow;
use App\Models\Catelog;
use App\Models\Customer;
use Illuminate\Http\Request;
use Laravel\Ui\Presets\React;

class BorrowController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (!auth()->user()->can('view.borrow')) {
            abort(403, 'Unauthorized action.');
        }
        $borrows = Borrow::query();
        $customers = Customer::where('status',1)->get();

        $books = Book::where('status',1)->get();
        if ($request->filled('customer_id')) {
            $borrows->where('customer_id', $request->customer_id);
        }
        if ($request->filled('book_id')) {
            $borrows->where('book_id', $request->book_id);
        }
        $borrows = $borrows
                   ->where('is_return','1')
                   ->paginate(1000);
        return view('backends.borrow.index', compact('borrows','customers','books'));
    }
    public function is_return(Request $request)
    {
        if (!auth()->user()->can('view.borrow')) {
            abort(403, 'Unauthorized action.');
        }
        $borrows = Borrow::query();
        $customers = Customer::where('status',1)->get();
        $books = Book::where('status',1)->get();
        if ($request->filled('customer_id')) {
            $borrows->where('customer_id', $request->customer_id);
        }
        if ($request->filled('book_id')) {
            $borrows->where('book_id', $request->book_id);
        }
        $borrows = $borrows->where('is_return','0')
                           ->paginate(1000);
        return view('backends.borrow.is_return',compact('borrows','customers','books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $catelogs = Catelog::all();
        $books = Book::where('status', 1)->get();
        $customers = Customer::where('status',1)->get();
        return view('backends.borrow.create', compact('books', 'catelogs', 'customers'));
    }
    public function fetchBooks($cate_id)
    {
        $borrowedBookIds = Borrow::where('is_return','1')->pluck('book_id')->flatten()->unique()->toArray();
        $books = Book::whereNotIn('id', $borrowedBookIds)
            ->where('cate_id',$cate_id)
            ->where('status', 1)
            ->pluck('book_code', 'id');
        return response()->json($books);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required',
            'book_id' => 'required',
            'borrow_date' => 'required'
        ]);
        try {
            $borrow = new Borrow();
            $borrow->customer_id = $request->customer_id;
            $borrow->book_id = $request->input('book_id');
            $borrow->catelog_id = $request->catelog_id;
            $borrow->created_by = auth()->user()->id;
            $lastBorrow = Borrow::withTrashed()->latest()->first();
            $borrow_code = optional($lastBorrow)->borrow_code;
            $newBorrowCode = null;
            if ($borrow_code) {
                $lastNumericPart = intval(substr($borrow_code, -5));
                $newNumericPart = $lastNumericPart + 1;
                $newBorrowCode = str_pad($newNumericPart, 5, '0', STR_PAD_LEFT);
            } else {
                $newBorrowCode = '00001';
            }
            while (Borrow::withTrashed()->where('borrow_code', $newBorrowCode)->exists()) {
                $newNumericPart++;
                $newBorrowCode = str_pad($newNumericPart, 5, '0', STR_PAD_LEFT);
            }
            $borrow->borrow_code = $newBorrowCode;
            $borrow->deposit_amount = $request->deposit_amount;
            $borrow->find_amount = $request->find_amount;
            $borrow->borrow_date = $request->borrow_date;
            $borrow->due_date = $request->due_date;
            $borrow->return_date = $request->return_date;
            $borrow->note = $request->note;
            $borrow->save();
            $output = [
                'success' => 1,
                'msg' => _('Create successfully')
            ];
        } catch (\Exception $e) {
            dd($e);
            $output = [
                'error' => 0,
                'msg' => _('Something went wrong')
            ];
        }
        return redirect()->route('borrow.index')->with($output);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $borrow = Borrow::find($id);
        $catelogs = Catelog::all();
        $books = Book::where('status', 1)->get();
        $customers = Customer::where('status',1)->get();
        return view('backends.borrow.show', compact('books', 'catelogs', 'customers','borrow'));
    }
    public function showIs_return(string $id)
    {
        $borrow = Borrow::find($id);
        $catelogs = Catelog::all();
        $books = Book::where('status', 1)->get();
        $customers = Customer::where('status',1)->get();
        return view('backends.borrow.show_is_return', compact('books', 'catelogs', 'customers','borrow'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function EditfetchBooks($cate_id)
    {
        $borrowedBookIds = Borrow::where('is_return', 0)->pluck('book_id');
        $books = Book::where('cate_id', $cate_id)
            ->where('status', 1)
            ->whereNotIn('id', $borrowedBookIds)
            ->pluck('book_code', 'id');
        return response()->json($books);
    }
    public function edit(string $id)
    {
        $borrow = Borrow::findOrFail($id);
        $catelogs = Catelog::all();
        $customers = Customer::all();
        $borrowedBookIds = Borrow::pluck('book_id')->flatten()->unique()->toArray();
        $borrowedBookIds = array_values(array_diff($borrowedBookIds, $borrow->book_id));
        // dd($borrow->book_id,$borrowedBookIds);
        $books = Book::where('cate_id', $borrow->catelog_id)
            ->where('status', 1)
            ->whereNotIn('id', $borrowedBookIds)
            ->pluck('book_code', 'id');

        return view('backends.borrow.edit', compact('borrow', 'catelogs', 'customers', 'books'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $borrow = Borrow::find($id);
            $borrow->customer_id = $request->customer_id;
            $borrow->book_id = $request->book_id;
            $borrow->catelog_id = $request->catelog_id;
            $borrow->created_by = auth()->user()->id;
            $borrow->borrow_code = $request->borrow_code;
            $borrow->deposit_amount = $request->deposit_amount;
            $borrow->find_amount = $request->find_amount;
            $borrow->borrow_date = $request->borrow_date;
            $borrow->due_date = $request->due_date;
            $borrow->return_date = $request->return_date;
            $borrow->note = $request->note;
            if ($request->input('return_date')) {
                $borrow->is_return = '0';
            }
            $borrow->save();
            $output = [
                'success' => 1,
                'msg' => _('Update successfully')
            ];
        } catch (\Exception $e) {
            dd($e);
            $output = [
                'error' => 0,
                'msg' => _('Something went wrong')
            ];
        }
        return redirect()->route('borrow.index')->with($output);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $borrow = Borrow::find($id);
            $borrow->delete();
            $output = [
                'success' => 1,
                'msg' => _('Delete successfully')
            ];
        } catch (\Exception $e) {
            dd($e);
            $output = [
                'error' => 0,
                'msg' => _('Something went wrong')
            ];
        }
        return redirect()->route('borrow.index')->with($output);
    }
}
