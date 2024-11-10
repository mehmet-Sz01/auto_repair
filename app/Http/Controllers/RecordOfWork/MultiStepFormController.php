<?php

namespace App\Http\Controllers\RecordOfWork;


use App\Http\Controllers\Controller;
use App\Http\Requests\RecordOfWork\MultiStepFormRequest;
use App\Models\RecordOfWork\Car;
use App\Models\RecordOfWork\Customer;
use App\Models\RecordOfWork\Work;
use Illuminate\Http\JsonResponse;


class MultiStepFormController extends Controller
{
    public function saveForm(MultiStepFormRequest $request): JsonResponse
    {

        $validated = $request->validate([
            'customer.first_name' => 'required|string|max:255',
            'customer.last_name' => 'required|string|max:255',
            'customer.number' => 'required|string|max:255',
            'customer.email' => 'required|email|max:255',

            'car.plate' => 'required|string|max:255',
            'car.brand' => 'required|string|max:255',
            'car.model' => 'required|string|max:255',
            'car.color' => 'required|string|max:255',
            'car.year' => 'required|date',
            'car.maintenance_date' => 'required|date',
            'car.inspection_date' => 'required|date',

            'work.work_title' => 'required|string|max:255',
            'work.description' => 'required|string|max:255',
            'work.price' => 'required|numeric',
            'work.worker_id' => 'required|exists:workers,id',
        ]);

        // Müşteri Kaydet
        $customer = Customer::create($validated['customer']);

// Araç Kaydet
        $car = new Car($validated['car']);
        $car->customer_id = $customer->id;
        $car->save();

// İş Bilgileri Kaydet
        $work = new Work($validated['work']);
        $work->car_id = $car->id;
        $work->customer_id = $customer->id;
        $work->save();

// Tüm yanıtları birleştirerek döndürüyoruz
        return response()->json([
            'customer' => $customer,
            'car' => $car,
            'work' => $work
        ]);

    }
}
