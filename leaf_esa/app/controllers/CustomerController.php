<?php

namespace App\Controllers;

use App\Models\Customer;

class CustomerController extends Controller
{
    function index()
    {
        $titre= 'Customers';
        $customers = Customer::select('CustomerId','Firstname','Lastname','City')->orderBy('CustomerId','DESC')->get();
        //$customers = Customer::all();
        render('customer.index',compact('customers','titre'));
    }

    function create()
    {
        $customer = new Customer();
        render('customer.create');
    }

    function store()
    {
        $data=request()->postData();
        $customer = new Customer();
        $customer->FirstName = $data['FirstName'];
        $customer->LastName = $data['LastName'];
        $customer->City = $data['City'];
        $customer->Email = $data['Email'];
        $customer->save();
        response()->redirect('/customers');
    }

    function edit(int $customerId) {
        $customer = Customer::find($customerId);
        render('customer.edit',compact('customer'));

    }

    function update() {
        $data=request()->postData();
        $customer = Customer::find($data['CustomerId']);
        $customer->FirstName = $data['FirstName'];
        $customer->LastName = $data['LastName'];
        $customer->City = $data['City'];
        $customer->Email = $data['Email'];
        $customer->save();
        response()->redirect(route('customers.index'));
    }

    function destroy() {
        $data = request()->postData();
        $customer = Customer::find($data['CustomerId']);
        $customer->delete();
        response()->redirect(route('customers.index'));
    }



}
