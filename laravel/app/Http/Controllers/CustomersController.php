<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use Exception;
use Illuminate\Support\Facades\Hash;

class CustomersController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin')->only(['index', 'create', 'store', 'destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $customers = Customer::query();
        if ($request->input('search')) {
            $customers = $customers->where('customerName', 'like', '%' . $request->input('search') . '%');
        }
        $customers = $customers->paginate(10);
        return view('customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Creation handled by register
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      // Creation handled by register
      abort(404);
    }

    /**
     * Display the specified resource.
     *
     * @param  Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Customer $customer)
    {
        if ($request->user()->is_admin || $request->user()->customer->customerNumber == $customer->customerNumber) {
            return view('customers.show', compact('customer'));
        }
        abort(403, 'You do not have access to this page');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Customer $customer)
    {
        if ($request->user()->is_admin || $request->user()->customer->customerNumber == $customer->customerNumber) {
            return view('customers.create', compact('customer'));
        }
        abort(403, 'You do not have access for this operation');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        //TODO: Form validation
        if ($request->user()->is_admin || $request->user()->customer->customerNumber == $customer->customerNumber) {
            $customer->update($request->all());
            return redirect()->action('CustomersController@show', [$customer]);
        }
        abort(403, 'You do not have access for this operation');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->action('CustomersController@index');
    }

    public function changePassword(Request $request, Customer $customer) {
        if ($request->user()->is_admin || $request->user()->customer->customerNumber == $customer->customerNumber) {
            $user = $customer->user;
            if (!$user) {
            throw new Exception('no user associated with customer');
            }
            if (!Hash::check($request->input('currentPassword'), $user->password)) {
            throw new Exception('wrong password');
            }
            $request->validate([
            'password' => 'required|confirmed',
            ]);
            $user->password = Hash::make($request->input('password'));
            $user->save();
            return redirect()->action('CustomersController@show', [$customer]);
        }
        abort(403, 'You do not have access for this operation');
    }

}