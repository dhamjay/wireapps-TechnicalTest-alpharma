<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;

use App\Models\Customer;
use App\Models\User;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        $customers = Customer::all();
        return response()->json([
        'status' => true,
        'customers' => $customers
        ]);
    }
    
    /**
     * Display the specified resource.
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {

        // $customer = Customer::all();
        if (!$customer) {
            return response()->json([
            'error' => 'Customer not found'
            ], 404);
        }
        return response()->json([
        'method' => 'customer.show',
        'customer' => $customer,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('is-owner');

        $request->validate([
        'name' => 'required|string',
        'email' => 'required|string',
        'phone' => 'required|string',      
        ]);

        $customer = Customer::create([
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'address' => $request->address,
        'type' => $request->type,
        ]);

        return response()->json([
        'message' => 'Customer created successfully', 
        'medication' => $customer
        ], 201);
    }

    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        $this->authorize('update-customer');

        $customer->update([
        'name' => ($request->name) ? $request->name : $customer->name,
        'email' => ($request->email) ? $request->email  : $customer->email,
        'phone' => ($request->phone)? $request->phone : $customer->phone,
        'address' => ($request->address) ? $request->address : $customer->address,
        'type' => ($request->type) ? $request->type : $customer->type,
        'updated_at' => now(),
        ]);

        return response()->json([
            'status' => true,
            'message' => "Customers Updated successfully!",
            'customers' => $customer
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        $this->authorize('unpublish-customer');

        $customer->delete();
        return response()->json([
        'status' => true,
        'message' => "Customer unpublished successfully!",
        ], 200);
    }

    /**
     * Restore specified resource
     * @return \Illuminate\Http\Response
     */
    public function restore($customerid) 
    {
        $this->authorize('unpublish-customer');

        Customer::where('id', $customerid)->withTrashed()->restore();
        return response()->json([
        'status' => $customerid,
        'message' => "Customer ID -s".$customerid." restored.",
        ], 200);
    }

    /**
     * Permanantly delete specified resource
     * @return \Illuminate\Http\Response
     */
    public function forceDelete($customerid) 
    {
        $this->authorize('is-owner');

        Customer::where('id', $customerid)->withTrashed()->forceDelete();
        return response()->json([
        'status' => $customerid,
        'message' => "Customer ID -s".$customerid." Deleted permanently!",
        ], 200);
    }
}
