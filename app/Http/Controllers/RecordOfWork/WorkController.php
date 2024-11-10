<?php

namespace App\Http\Controllers\RecordOfWork;

use App\Http\Controllers\Controller;
use App\Http\Requests\RecordOfWork\MultiStepFormRequest;
use App\Models\RecordOfWork\Work;
use Illuminate\Http\JsonResponse;

class WorkController extends Controller
{
    public function getWork()
    {
        return Work::with('worker','car','customer')->get();
    }

    public function store(MultiStepFormRequest $request):JsonResponse
    {

        $work = Work::create([
            'work_title' => $request->work_title,
            'car_id' => $request->car_id,
            'worker_id' => $request->worker_id,
            'description' => $request->description,
            'price' => $request->price,
            'customer_id' => $request->customer_id,
        ]);

        return response()->json(['message' => 'İş başarıyla kaydedildi!', 'work' => $work], 201);
    }


}
