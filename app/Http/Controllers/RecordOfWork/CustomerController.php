<?php

namespace App\Http\Controllers\RecordOfWork;

use App\Http\Controllers\Controller;
use App\Http\Requests\RecordOfWork\CustomerRequest;
use App\Models\RecordOfWork\Customer;

class CustomerController extends Controller
{
    public function store(CustomerRequest $request)
    {

        $customer = Customer::create($request->only(['first_name', 'last_name', 'number', 'email']));

        return response()->json(['message' => 'Müşteri başarıyla kaydedildi!', 'customer' => $customer], 201);
    }

}
