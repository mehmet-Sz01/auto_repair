<?php

// app/Http/Requests/WorkRequest.php

namespace App\Http\Requests\RecordOfWork;

use Illuminate\Foundation\Http\FormRequest;

class WorkRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'work_title' => 'required|string|max:255',
            'car_id' => 'required|exists:cars,id',
            'worker_id' => 'required|exists:workers,id',
            'description' => 'required|string',
            'price' => 'required|numeric',
        ];
    }
}
