<?php

namespace App\Http\Controllers\RecordOfWork;

use App\Http\Controllers\Controller;
use App\Http\Requests\RecordOfWork\MultiStepFormRequest;
use App\Models\RecordOfWork\Car;
use Illuminate\Http\JsonResponse;

class CarController extends Controller
{
    public function store(MultiStepFormRequest $request):JsonResponse
    {
        $car = Car::create($request->only(['plate', 'brand', 'model', 'color', 'year', 'maintenance_date', 'inspection_date', 'customer_id']));

        return response()->json(['message' => 'Araç başarıyla kaydedildi!', 'car' => $car], 201);
    }
}
