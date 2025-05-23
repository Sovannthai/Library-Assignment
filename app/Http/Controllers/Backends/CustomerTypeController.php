<?php

namespace App\Http\Controllers\Backends;

use App\Http\Controllers\Controller;
use App\Models\CustomerType;
use Illuminate\Http\Request;

class CustomerTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!auth()->user()->can('view.customer')) {
            abort(403, 'Unauthorized action.');
        }
        $customer_types = CustomerType::paginate(10);
        return view('backends.customer_type.index',compact('customer_types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $customer_type = new CustomerType();
            $customer_type->name = $request->name;
            $customer_type->save();
            $output = [
                'success'=>1,
                'msg'=>('Create successfully')
            ];
        }catch(\Exception $e){
            $output = [
                'error'=>0,
                'msg'=>('Something went wrong')
            ];
        }
        return redirect()->route('customer_type.index')->with($output);
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try{
            $customer_type = CustomerType::find($id);
            $customer_type->name = $request->name;
            $customer_type->save();
            $output = [
                'success'=>1,
                'msg'=>('Update successfully')
            ];
        }catch(\Exception $e){
            $output = [
                'error'=>0,
                'msg'=>('Something went wrong')
            ];
        }
        return redirect()->route('customer_type.index')->with($output);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $customer_type = CustomerType::find($id);
            $customer_type->delete();
            $output = [
                'success'=>1,
                'msg'=>('Delete successfully')
            ];
        }catch(\Exception $e){
            $output = [
                'error'=>0,
                'msg'=>('Something went wrong')
            ];
        }
        return redirect()->route('customer_type.index')->with($output);
    }
}
