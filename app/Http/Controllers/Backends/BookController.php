<?php

namespace App\Http\Controllers\Backends;

use Exception;
use App\Models\Book;
use App\Models\Catelog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BookController extends Controller
{
    public function updateStatus(Request $request)
    {
        try {
            $status = $request->input('status') === 'true' ? '1' : '0';
            $book = Book::findOrFail($request->input('id'));
            $book->update(['status' => $status]);
            $output = [
                'success' => 1,
                'msg' => _('Status update successfully')
            ];
        } catch (Exception $e) {
            dd($e);
            $output = [
                'error' => 0,
                'msg' => _('Something went wrong')
            ];
        }
        return response()->json($output);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (!auth()->user()->can('view.book')) {
            abort(403, 'Unauthorized action.');
        }

        $catelogs = Catelog::all();
        $books = Book::when($request->cate_id, function ($query) use ($request) {
            $query->where('cate_id', $request->cate_id);
        })->latest()->paginate(25);
        if ($request->ajax()) {
            $view = view('backends.catelog_and_book.book._table_book', compact('books', 'catelogs'))->render();
            return response()->json([
                'view' => $view
            ]);
        }
        return view('backends.catelog_and_book.book.index', compact('books', 'catelogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!auth()->user()->can('create.book')) {
            abort(403, 'Unauthorized action.');
        }
        $catelogs = Catelog::where('status',1)->get();
        return view('backends.catelog_and_book.book.create', compact('catelogs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'book_code' => 'required|unique:books,book_code',
            'cate_id' => 'required'
        ]);
        try {
            $book = new Book();
            $book->cate_id = $request->cate_id;
            $book->book_code = $request->book_code;
            $book->description = $request->description;
            $book->created_by = auth()->user()->id;
            $book->save();
            $output = [
                'success' => 1,
                'msg' => _('Create successfully')
            ];
        } catch (\Exception $e) {
            $output = [
                'error' => 0,
                'msg' => _('Someting went wrong')
            ];
        }
        return redirect()->route('book.index')->with($output);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if (!auth()->user()->can('edit.book')) {
            abort(403, 'Unauthorized action.');
        }
        $catelogs = Catelog::all();
        $book = Book::find($id);
        return view('backends.catelog_and_book.book.edit', compact('catelogs', 'book'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'book_code' => 'required|unique:books,book_code,'.$id,
            'cate_id' => 'required'
        ]);
        try {
            $book = Book::find($id);
            $book->cate_id = $request->cate_id;
            $book->book_code = $request->book_code;
            $book->description = $request->description;
            $book->created_by = auth()->user()->id;
            $book->save();
            $output = [
                'success' => 1,
                'msg' => _('Update successfully')
            ];
        } catch (\Exception $e) {
            $output = [
                'error' => 0,
                'msg' => _('Someting went wrong')
            ];
        }
        return redirect()->route('book.index')->with($output);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $book = Book::find($id);
            $book->delete();
            $output = [
                'success' => 1,
                'msg' => _('Delete successfully')
            ];
        } catch (\Exception $e) {
            $output = [
                'error' => 0,
                'msg' => _('Someting went wrong')
            ];
        }
        return redirect()->route('book.index')->with($output);
    }
}
