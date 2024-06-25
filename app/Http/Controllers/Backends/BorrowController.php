<?php

namespace App\Http\Controllers\Backends;

use App\Models\Book;
use App\Models\Borrow;
use GuzzleHttp\Client;
use App\Models\Catelog;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\TelegramAlertNotification;
use App\Notifications\Channels\TelegramNotificationChannel;

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
        $search =  request('search');
        $borrows = Borrow::when($request->customer_id, function ($query) use ($request) {
            $query->where('customer_id', $request->customer_id);
        })->when(request()->filled('search'), function ($query) use ($search) {
            return $query->whereHas('customer', function ($customer) use ($search) {
                $customer->where('name', 'LIKE', '%' . $search . '%');
            })
            ->orWhere('borrow_code', 'LIKE', '%' . $search . '%')
            ->orWhere(function ($query) use ($search) {
                // Get the IDs of books that match the search criteria
                $bookIds = Book::where('status', 1)
                               ->where('book_code', 'LIKE', '%' . $search . '%')
                               ->pluck('id')
                               ->toArray();

                // Add a condition to check if the book_id JSON array contains any of the matching book IDs using raw SQL
                $query->where(function ($query) use ($bookIds) {
                    foreach ($bookIds as $bookId) {
                        $query->orWhereRaw('JSON_CONTAINS(book_id, ?)', [$bookId]);
                    }
                });
            });
        })->where('is_return', '1')->OrderBy('borrow_code', 'desc')->paginate(10);
        $total_deposite = $borrows->sum('deposit_amount');
        $total_find_amount = $borrows->sum('find_amount');
        $customers = Customer::where('status', 1)->get();
        $catalogs = Catelog::where('status', 1)->get();
        $books = Book::where('status', 1)->get();
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
        $borrows = Borrow::when($request->customer_id, function ($query) use ($request) {
            $query->where('customer_id', $request->customer_id);
        })->where('is_return', '0')->paginate(10);
        $total_deposite = $borrows->sum('deposit_amount');
        $total_find_amount = $borrows->sum('find_amount');
        $customers = Customer::where('status', 1)->get();
        $catalogs = Catelog::where('status', 1)->get();
        $books = Book::where('status', 1)->get();
        if ($request->ajax()) {
            $view = view('backends.borrow._table_is_return', compact('borrows', 'customers', 'total_deposite', 'total_find_amount'))->render();
            return response()->json([
                'view' => $view
            ]);
        }
        return view('backends.borrow.is_return', compact('borrows', 'customers', 'total_deposite', 'total_find_amount'));
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
        $borrowedBookIds = Borrow::where('is_return', '1')->pluck('book_id')->flatten()->unique()->toArray();
        $books = Book::where('status', 1)
            ->whereNotIn('id', $borrowedBookIds)
            ->get();
        $customerBorrowId = Borrow::where('is_return', '1')->pluck('customer_id');
        $customers = Customer::where('status', 1)
            ->whereNotIn('id', $customerBorrowId)
            ->get();
        return view('backends.borrow.create', compact('books', 'catelogs', 'customers'));
    }
    // public function fetchBooks($cate_id)
    // {
    //     $borrowedBookIds = Borrow::where('is_return','1')->pluck('book_id')->flatten()->unique()->toArray();
    //     $books = Book::whereNotIn('id', $borrowedBookIds)
    //         ->where('cate_id',$cate_id)
    //         ->where('status', 1)
    //         ->pluck('book_code', 'id');
    //     return response()->json($books);
    // }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
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
            $borrow->deposit_amount = $request->deposit_amount ?? 0;
            $borrow->find_amount = $request->find_amount ?? 0;
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
        $customers = Customer::where('status', 1)->get();
        return view('backends.borrow.show', compact('books', 'catelogs', 'customers', 'borrow'));
    }
    public function showIs_return(string $id)
    {
        $borrow = Borrow::find($id);
        $catelogs = Catelog::all();
        $books = Book::where('status', 1)->get();
        $customers = Customer::where('status', 1)->get();
        return view('backends.borrow.show_is_return', compact('books', 'catelogs', 'customers', 'borrow'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    // public function EditfetchBooks($cate_id)
    // {
    //     $borrowedBookIds = Borrow::where('is_return', 0)->pluck('book_id');
    //     $books = Book::where('cate_id', $cate_id)
    //         ->where('status', 1)
    //         ->whereNotIn('id', $borrowedBookIds)
    //         ->pluck('book_code', 'id');
    //     return response()->json($books);
    // }
    // public function edit(string $id)
    // {
    //     $borrow = Borrow::findOrFail($id);
    //     $catelogs = Catelog::all();
    //     $customers = Customer::all();
    //     $borrowedBookIds = Borrow::pluck('book_id')->flatten()->unique()->toArray();
    //     $borrowedBookIds = array_values(array_diff($borrowedBookIds, $borrow->book_id));
    //     // dd($borrow->book_id,$borrowedBookIds);
    //     $books = Book::where('cate_id', $borrow->catelog_id)
    //         ->where('status', 1)
    //         ->whereNotIn('id', $borrowedBookIds)
    //         ->pluck('book_code', 'id');

    //     return view('backends.borrow.edit', compact('borrow', 'catelogs', 'customers', 'books'));
    // }
    public function edit(string $id)
    {
        // if (!auth()->user()->can('update.borrow')) {
        //     abort(403, 'Unauthorized action.');
        // }
        $borrow = Borrow::findOrFail($id);
        $catelogs = Catelog::all();
        $customers = Customer::all();
        $books = Book::all();
        return view('backends.borrow.edit', compact('borrow', 'catelogs', 'customers', 'books'));
    }

    public function return_book(Request $request, $id)
    {
        try {
            $borrow = Borrow::find($id);
            $borrow->find_amount = $request->find_amount ?? 0;
            $borrow->return_date = $request->return_date;
            if ($request->input('return_date')) {
                $borrow->is_return = '0';
            }
            $borrow->save();
            $output = [
                'success' => 1,
                'msg' => _('Return successfully')
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
            $borrow->deposit_amount = $request->deposit_amount ?? 0;
            $borrow->find_amount = $request->find_amount ?? 0;
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

    public function sendTelegramNotification($borrowId)
    {
        $telegramBotToken = env('TELEGRAM_BOT_TOKEN'); // Retrieve bot token

        $borrow = Borrow::with('customer')->findOrFail($borrowId);
        $customer = $borrow->customer;

        if ($customer && $customer->telegram_chat_id) {
            $message = "Dear Customer, **" . $customer->telegram_username . "**,\n\n";
            $message .= "This is a friendly reminder to please return the book to our library at your earliest convenience.\n\n";
            $message .= "Due Date: ". $borrow->due_date ."\n\n";
            $message .= "Thank you for your attention to this matter!\n\n";
            $message .= "Best regards,\n";
            $message .= "**" . auth()->user()->name . "**";
            $this->sendTelegramNotificationManually($customer->telegram_chat_id, $message, $telegramBotToken);
            $data = [
                'success' => 1,
                'msg' => 'Telegram notification sent successfully'
            ];
            return redirect()->back()->with($data);
        }
        $data = [
            'error' => 1,
            'msg' => 'Customer does not have a Telegram chat ID set'
        ];
        return redirect()->back()->with($data);
    }
    private function sendTelegramNotificationManually($chatId, $message, $telegramBotToken)
    {
        $url = "https://api.telegram.org/bot{$telegramBotToken}/sendMessage";
        $client = new Client([
            'verify' => false,
        ]);
        $data = $client->post('https://api.telegram.org/bot' . env('TELEGRAM_BOT_TOKEN') . '/sendMessage', [
            'json' => [
                'chat_id' => $chatId,
                'text' => $message,
            ],
        ]);
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        $response = curl_exec($ch);
        curl_close($ch);
    }
}
