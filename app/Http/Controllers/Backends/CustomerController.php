<?php

namespace App\Http\Controllers\Backends;

use Exception;
use App\Models\Customer;
use App\Models\CustomerType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    public function updateStatus(Request $request)
    {
        try {
            $status = $request->input('status') === 'true' ? '1' : '0';
            $customer = Customer::findOrFail($request->input('id'));
            $customer->update(['status' => $status]);
            $output = [
                'success' => 1,
                'msg' =>('Status update successfully')
            ];
        } catch (Exception $e) {
            dd($e);
            $output = [
                'error' => 0,
                'msg' =>('Something went wrong')
            ];
        }
        return response()->json($output);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (!auth()->user()->can('view.customer')) {
            abort(403, 'Unauthorized action.');
        }
        $customer_types = CustomerType::all();
        $customers = Customer::when($request->customer_type_id, function ($query) use ($request) {
            $query->where('customer_type_id', $request->customer_type_id);
        })
        ->when($request->status !== null, function ($query) use ($request) {
            $query->where('status', $request->status);
        })->paginate(10);
        if ($request->ajax()) {
            $view = view('backends.customer._table_customer', compact('customers', 'customer_types'))->render();
            return response()->json([
                'view' => $view
            ]);
        }
        return view('backends.customer.index', compact('customers', 'customer_types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!auth()->user()->can('create.customer')) {
            abort(403, 'Unauthorized action.');
        }
        $customer_types = CustomerType::all();
        $genders = ['male' => 'Male', 'female' => 'Female', 'another' => 'Another'];
        return view('backends.customer.create', compact('customer_types', 'genders'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:customers,code',
            'customer_type_id' => 'required'
        ]);
        try {
            $customer = new Customer();
            $customer->telegram_token = $request->telegram_token;
            $customer->telegram_chat_id = $request->telegram_chat_id;
            $customer->telegram_username = $request->telegram_username ?? $customer->name = $request->name;
            $customer->code = $request->code;
            $customer->name = $request->name;
            $customer->customer_type_id = $request->customer_type_id;
            $customer->sex = $request->sex;
            $customer->dob = $request->dob;
            $customer->phone = $request->phone;
            $customer->pob = $request->pob;
            $customer->address = $request->address;
            $customer->save();
            $output = [
                'success' => 1,
                'msg' =>('Create successfully')
            ];
        } catch (\Exception $e) {
            $output = [
                'error' => 0,
                'msg' =>('Something went wrong')
            ];
        }
        return redirect()->route('customer.index')->with($output);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $customer = Customer::find($id);
        $customer_types = CustomerType::all();
        $genders = ['male' => 'Male', 'female' => 'Female', 'another' => 'Another'];
        return view('backends.customer.show', compact('customer_types', 'genders','customer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if (!auth()->user()->can('edit.customer')) {
            abort(403, 'Unauthorized action.');
        }
        $customer_types = CustomerType::all();
        $customer = Customer::find($id);
        $genders = ['male' => 'Male', 'female' => 'Female', 'another' => 'Another'];
        return view('backends.customer.edit',compact('customer_types','customer','genders'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $request->validate([
            'code' => 'required|unique:customers,code,'.$id,
            'customer_type_id' => 'required'
        ]);
        try {
            $customer = Customer::find($id);
            $customer->telegram_token = $request->telegram_token;
            $customer->telegram_chat_id = $request->telegram_chat_id;
            $customer->telegram_username = $request->telegram_username ?? $customer->name = $request->name;
            $customer->code = $request->code;
            $customer->name = $request->name;
            $customer->customer_type_id = $request->customer_type_id;
            $customer->sex = $request->sex;
            $customer->dob = $request->dob;
            $customer->phone = $request->phone;
            $customer->pob = $request->pob;
            $customer->address = $request->address;
            $customer->save();
            $output = [
                'success' => 1,
                'msg' =>('Update successfully')
            ];
        } catch (\Exception $e) {
            $output = [
                'error' => 0,
                'msg' =>('Something went wrong')
            ];
        }
        return redirect()->route('customer.index')->with($output);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $customer = Customer::find($id);
            $customer->delete();
            $output = [
                'success' => 1,
                'msg' =>('Delete successfully')
            ];
        } catch (\Exception $e) {
            $output = [
                'error' => 0,
                'msg' =>('Something went wrong')
            ];
        }
        return redirect()->route('customer.index')->with($output);
    }
}
