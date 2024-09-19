<?php

namespace App\Http\Controllers\RecordOfWork;

use App\Http\Controllers\Controller;
use App\Http\Requests\RecordOfWork\WorkRequest;
use App\Models\RecordOfWork\Work;

class WorkController extends Controller
{


    public function store(WorkRequest $request)
    {

        $work = Work::create([
            'work_title' => $request->work_title,
            'car_id' => $request->car_id,
            'worker_id' => $request->worker_id,
            'description' => $request->description,
            'price' => $request->price,
        ]);

        return response()->json(['message' => 'İş başarıyla kaydedildi!', 'work' => $work], 201);
    }


}
