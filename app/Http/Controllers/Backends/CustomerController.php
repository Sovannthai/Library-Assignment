<?php

namespace App\Http\Controllers\Backends;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\CustomerType;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (!auth()->user()->can('view.customer')) {
            abort(403, 'Unauthorized action.');
        }
        $customers = Customer::query();
        $customer_types = CustomerType::all();
        if ($request->filled('customer_type_id')) {
            $customers->where('customer_type_id', $request->customer_type_id);
        }
        $customers = $customers->paginate(10);
        return view('backends.customer.index', compact('customers','customer_types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
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
                'msg' => _('Create successfully')
            ];
        } catch (\Exception $e) {
            $output = [
                'error' => 0,
                'msg' => _('Something went wrong')
            ];
        }
        return redirect()->route('customer.index')->with($output);
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
                'msg' => _('Update successfully')
            ];
        } catch (\Exception $e) {
            $output = [
                'error' => 0,
                'msg' => _('Something went wrong')
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
                'msg' => _('Delete successfully')
            ];
        } catch (\Exception $e) {
            $output = [
                'error' => 0,
                'msg' => _('Something went wrong')
            ];
        }
        return redirect()->route('customer.index')->with($output);
    }
}
