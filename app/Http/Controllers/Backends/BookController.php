<?php

namespace App\Http\Controllers\Backends;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Catelog;
use Illuminate\Http\Request;
use Laravel\Ui\Presets\React;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (!auth()->user()->can('view.book')) {
            abort(403, 'Unauthorized action.');
        }
        $books = Book::query();
        $catelogs = Catelog::all();
        if ($request->filled('cate_id')) {
            $books->where('cate_id', $request->cate_id);
        }
        $books = $books->paginate(10);
        return view('backends.catelog_and_book.book.index',compact('books','catelogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $catelogs = Catelog::all();
        return view('backends.catelog_and_book.book.create',compact('catelogs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'book_code'=>'required',
            'cate_id'=>'required'
        ]);
        try{
            $book = new Book();
            $book->cate_id = $request->cate_id;
            $book->book_code = $request->book_code;
            $book->description = $request->description;
            $book->save();
            $output = [
                'success'=>1,
                'msg'=>_('Create successfully')
            ];
        }catch(\Exception $e){
            $output = [
                'error'=>0,
                'msg'=>_('Someting went wrong')
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
        $catelogs = Catelog::all();
        $book = Book::find($id);
        return view('backends.catelog_and_book.book.edit',compact('catelogs','book'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try{
            $book = Book::find($id);
            $book->cate_id = $request->cate_id;
            $book->book_code = $request->book_code;
            $book->description = $request->description;
            $book->save();
            $output = [
                'success'=>1,
                'msg'=>_('Update successfully')
            ];
        }catch(\Exception $e){
            $output = [
                'error'=>0,
                'msg'=>_('Someting went wrong')
            ];
        }
        return redirect()->route('book.index')->with($output);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $book = Book::find($id);
            $book->delete();
            $output = [
                'success'=>1,
                'msg'=>_('Delete successfully')
            ];
        }catch(\Exception $e){
            $output = [
                'error'=>0,
                'msg'=>_('Someting went wrong')
            ];
        }
        return redirect()->route('book.index')->with($output);
    }
}
