<?php

namespace App\Http\Controllers\Backends;

use App\Models\Book;
use App\Models\Borrow;
use GuzzleHttp\Client;
use App\Models\Catelog;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BorrowDetail;

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
        $search = $request->input('search');
        $cate_id = $request->input('cate_id');

        $borrows = Borrow::with('borrow_detail.book')
            ->when($request->customer_id, function ($query) use ($request) {
                $query->where('customer_id', $request->customer_id);
            })
            ->when($request->filled('search'), function ($query) use ($search) {
                $query->whereHas('customer', function ($customer) use ($search) {
                    $customer->where('name', 'LIKE', '%' . $search . '%');
                })
                ->orWhere('borrow_code', 'LIKE', '%' . $search . '%')
                ->orWhereHas('borrow_detail', function ($detail) use ($search) {
                        $bookIds = Book::where('status', 1)
                            ->where('book_code', 'LIKE', '%' . $search . '%')
                            ->orWhereHas('catelog', function ($query) use ($search) {
                                $query->where('cate_name', 'LIKE', '%' . $search . '%');
                            })
                               ->pluck('id')
                               ->toArray();
                        $detail->whereIn('book_id', $bookIds);
                    });
            })
            ->when($request->filled('cate_id'), function ($query) use ($cate_id) {
                $query->whereHas('borrow_detail.book', function ($query) use ($cate_id) {
                    $query->where('cate_id', $cate_id);
                });
            })
            ->where('is_return', '1')
            ->orderBy('borrow_code', 'desc')
            ->paginate(10);
        $total_deposite    = $borrows->sum('deposit_amount');
        $total_find_amount = $borrows->sum('find_amount');
        $customers         = Customer::where('status', 1)->get();
        $catalogs          = Catelog::where('status', 1)->get();
        $books             = Book::where('status', 1)->get();
        if ($request->ajax()) {
            $view = view('backends.borrow._table_borrow', compact('borrows', 'customers', 'catalogs', 'books', 'total_deposite', 'total_find_amount'))->render();
            return response()->json([
                'view' => $view
            ]);
        }
        return view('backends.borrow.index', compact('borrows', 'customers', 'catalogs', 'books', 'total_deposite', 'total_find_amount'));
    }
    public function is_return(Request $request)
    {
        if (!auth()->user()->can('view.borrow')) {
            abort(403, 'Unauthorized action.');
        }
        $search = $request->input('search');
        $cate_id = $request->input('cate_id');

        $borrows = Borrow::with('borrow_detail.book')
            ->when($request->customer_id, function ($query) use ($request) {
                $query->where('customer_id', $request->customer_id);
            })
            ->when($request->filled('search'), function ($query) use ($search) {
                $query->whereHas('customer', function ($customer) use ($search) {
                    $customer->where('name', 'LIKE', '%' . $search . '%');
                })
                    ->orWhere('borrow_code', 'LIKE', '%' . $search . '%')
                    ->orWhereHas('borrow_detail', function ($detail) use ($search) {
                        $bookIds = Book::where('status', 1)
                            ->where('book_code', 'LIKE', '%' . $search . '%')
                            ->orWhereHas('catelog', function ($query) use ($search) {
                                $query->where('cate_name', 'LIKE', '%' . $search . '%');
                            })
                            ->pluck('id')
                            ->toArray();
                        $detail->whereIn('book_id', $bookIds);
                    });
            })->when($request->filled('cate_id'), function ($query) use ($cate_id) {
                $query->whereHas('borrow_detail.book', function ($query) use ($cate_id) {
                    $query->where('cate_id', $cate_id);
                });
            })
            ->where('is_return', '0')
            ->orderBy('borrow_code', 'desc')
            ->paginate(10);
        $total_deposite = $borrows->sum('deposit_amount');
        $total_find_amount = $borrows->sum('find_amount');
        $customers = Customer::where('status', 1)->get();
        $catalogs = Catelog::where('status', 1)->get();
        $books = Book::where('status', 1)->get();
        if ($request->ajax()) {
            $view = view('backends.borrow._table_is_return', compact('borrows', 'customers', 'total_deposite', 'total_find_amount', 'catalogs'))->render();
            return response()->json([
                'view' => $view
            ]);
        }
        return view('backends.borrow.is_return', compact('borrows', 'customers', 'total_deposite', 'total_find_amount', 'catalogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!auth()->user()->can('create.borrow')) {
            abort(403, 'Unauthorized action.');
        }
        $catelogs = Catelog::all();
        $borrowedBookIds = BorrowDetail::where('is_return', '1')->pluck('book_id')->flatten()->unique()->toArray();
        $books = Book::where('status', 1)
            ->whereNotIn('id', $borrowedBookIds)
            ->orderBy('book_code', 'asc')
            ->get();
        $customerBorrowId = Borrow::where('is_return', '1')->pluck('customer_id');
        $customers = Customer::where('status', 1)
            ->whereNotIn('id', $customerBorrowId)
            ->get();
        return view('backends.borrow.create', compact('books', 'catelogs', 'customers'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required',
            'book_id' => 'required',
            'borrow_date' => 'required'
        ]);
        try {
            $borrow = new Borrow();
            // $borrow->book_id = $request->input('book_id');
            $borrow->customer_id = $request->customer_id;
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
            $borrow->deposit_amount = $request->deposit_amount ?? 0;
            $borrow->borrow_date = $request->borrow_date;
            $borrow->due_date = $request->due_date;
            $borrow->note = $request->note;
            $borrow->save();
            foreach ($request->input('book_id') as $book_id) {
                $borrow_detail = new BorrowDetail();
                $borrow_detail->borrow_id = $borrow->id;
                $borrow_detail->customer_id = $request->customer_id;
                $borrow_detail->is_return = 1;
                $borrow_detail->book_id = $book_id;
                $borrow_detail->return_date = $request->return_date;
                $borrow_detail->find_amount = $request->find_amount ?? 0;
                $borrow_detail->save();
                $borrow->borrow_detail()->save($borrow_detail);
            }
            $output = [
                'success' => 1,
                'msg' => ('Create successfully')
            ];
        } catch (\Exception $e) {
            dd($e);
            $output = [
                'error' => 0,
                'msg' => ('Something went wrong')
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
        $customers = Customer::where('status', 1)->get();
        return view('backends.borrow.show', compact('books', 'catelogs', 'customers', 'borrow'));
    }
    public function showIs_return(string $id)
    {
        $borrow = Borrow::findOrFail($id);
        $catelogs = Catelog::all();
        $customers = Customer::all();
        $books = BorrowDetail::where('book_id', $borrow->book_id)->get();
        return view('backends.borrow.show_is_return', compact('books', 'catelogs', 'customers', 'borrow'));
    }
    public function edit(string $id)
    {
        $borrow = Borrow::findOrFail($id);
        $catelogs = Catelog::all();
        $customers = Customer::all();
        $books = Book::all();
        $book_ids = $borrow->borrow_detail->pluck('book_id')->toArray();
        return view('backends.borrow.edit', compact('borrow', 'catelogs', 'customers', 'books', 'book_ids'));
    }

    // public function get_borrow_books(string $id)
    // {
    //     $book_borrows = Borrow::find($id);
    //     $book_ids = $book_borrows->borrow_detail->pluck('book_id')->toArray();
    //     return view('backends.borrow.return_book',compact('book_borrows', 'book_ids'));
    // }
    public function return_book(Request $request, $id)
    {
        try {
            $borrow = Borrow::find($id);
            $borrow_details = $borrow->borrow_detail;
            $borrow->return_date = $request->return_date;
            if ($request->input('return_date')) {
                $borrow->is_return = '0';
            }
            foreach ($borrow_details as $borrow_detail) {
                $borrow_detail->update([
                    'is_return' => '0',
                    'return_date' => $request->return_date,
                    'find_amount' => $request->find_amount ?? 0,
                ]);
            }
            $borrow->save();
            $output = [
                'success' => 1,
                'msg' => ('Return successfully')
            ];
        } catch (\Exception $e) {
            dd($e);
            $output = [
                'error' => 0,
                'msg' => ('Something went wrong')
            ];
        }
        return redirect()->route('borrow.index')->with($output);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $borrow = Borrow::find($id);
            $borrow->customer_id = $request->customer_id;
            // $borrow->book_id = $request->book_id;
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
            // $borrow->borrow_code = $newBorrowCode;
            $borrow->deposit_amount = $request->deposit_amount ?? 0;
            $borrow->borrow_date = $request->borrow_date;
            $borrow->due_date = $request->due_date;
            $borrow->save();
            BorrowDetail::where('borrow_id', $borrow->id)->delete();
            foreach ($request->input('book_id') as $book_id) {
                $borrow_detail = new BorrowDetail();
                $borrow_detail->borrow_id   = $borrow->id;
                $borrow_detail->customer_id = $request->customer_id;
                $borrow_detail->book_id     = $book_id;
                $borrow_detail->is_return   = 1;
                $borrow_detail->return_date = $request->return_date;
                $borrow_detail->find_amount = $request->find_amount ?? 0;
                $borrow_detail->save();
                $borrow->borrow_detail()->save($borrow_detail);
            }
            $output = [
                'success' => 1,
                'msg'     => ('Update successfully')
            ];
        } catch (\Exception $e) {
            dd($e);
            $output = [
                'error' => 0,
                'msg'   => ('Something went wrong')
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
                'msg' => ('Delete successfully')
            ];
        } catch (\Exception $e) {
            dd($e);
            $output = [
                'error' => 0,
                'msg' => ('Something went wrong')
            ];
        }
        return redirect()->route('borrow.index')->with($output);
    }

    public function sendTelegramNotification($borrowId)
    {
        $telegramBotToken = env('TELEGRAM_BOT_TOKEN'); // Retrieve bot token

        $borrow = Borrow::with('customer')->findOrFail($borrowId);
        $customer = $borrow->customer;

        if ($customer && $customer->telegram_chat_id) {
            $message  = "Dear Customer, " . $customer->telegram_username . ",\n\n";
            $message .= "This is a friendly reminder to please return the book to our library at your earliest convenience.\n\n";
            $message .= "Due Date: " . $borrow->due_date . "\n\n";
            $message .= "Thank you for your attention to this matter!\n\n";
            $message .= "Best regards, " . auth()->user()->name;
            $this->sendTelegramNotificationManually($customer->telegram_chat_id, $message, $telegramBotToken);
            $data = [
                'success' => 1,
                'msg'     => 'Notification sent successfully'
            ];
            return redirect()->back()->with($data);
        }
        $data = [
            'error' => 1,
            'msg'   => 'Customer does not have a Telegram chat ID set'
        ];
        return redirect()->back()->with($data);
    }
    private function sendTelegramNotificationManually($chatId, $message, $telegramBotToken)
    {
        $url = "https://api.telegram.org/bot{$telegramBotToken}/sendMessage";
        $client = new Client([
            'verify' => false,
        ]);
        try {
            $response = $client->post($url, [
                'json' => [
                    'chat_id' => $chatId,
                    'text'    => $message,
                ],
            ]);
            $responseData = json_decode($response->getBody(), true);
            if ($responseData['ok']) {
                return "Message sent successfully!";
            } else {
                return "Failed to send message: " . $responseData['description'];
            }
        } catch (\Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }
}
