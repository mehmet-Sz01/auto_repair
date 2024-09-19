<?php

namespace App\Http\Controllers\RecordOfWork;

use App\Http\Controllers\Controller;
use App\Http\Requests\RecordOfWork\MultiStepFormRequest;
use App\Models\RecordOfWork\Car;
use App\Models\RecordOfWork\Customer;
use App\Models\RecordOfWork\Work;


class MultiStepFormController extends Controller
{
    public function saveForm(MultiStepFormRequest $request)
    {
        // Validation
        $validated = $request->validate([]);

        // Müşteri Kaydet
        $customer = Customer::create($validated['customer']);

        // Araç Kaydet
        $car = new Car($validated['car']);
        $car->customer_id = $customer->id;
        $car->save();

        // İş Bilgileri Kaydet
        $work = new Work($validated['work']);
        $work->car_id = $car->id;
        $work->save();

        return response()->json(['message' => 'Form başarıyla kaydedildi!'], 201);
    }
}
