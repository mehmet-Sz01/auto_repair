<?php

namespace App\Http\Controllers\RecordOfWork;

use App\Http\Controllers\Controller;
use App\Http\Requests\RecordOfWork\MultiStepFormRequest;
use App\Models\RecordOfWork\Customer;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;

class CustomerController extends Controller
{

    public function getCustomers(): Collection
    {
        return Customer::all(['first_name', 'last_name', 'number', 'email']);

    }

    public function store(MultiStepFormRequest $request): JsonResponse
    {

        $customer = Customer::create($request->only(['first_name', 'last_name', 'number', 'email']));

        return response()->json(['message' => 'Müşteri başarıyla kaydedildi!', 'customer' => $customer], 201);
    }

}
