<?php

// app/Http/Requests/CarRequest.php

namespace App\Http\Requests\RecordOfWork;

use Illuminate\Foundation\Http\FormRequest;

class CarRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'plate' => 'required|string|max:10',
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'color' => 'required|string|max:50',
            'maintenance_date' => 'required|date',
            'inspection_date' => 'required|date',
            'customer_id' => 'required|exists:customers,id',
        ];
    }
}
