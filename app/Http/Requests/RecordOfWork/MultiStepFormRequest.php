<?php

namespace App\Http\Requests\RecordOfWork;

use Illuminate\Foundation\Http\FormRequest;

class MultiStepFormRequest extends FormRequest
{
    public function authorize()
    {
        // Kullanıcı yetkilendirme kontrolü, şimdilik true olarak ayarlandı.
        return true;
    }

    public function rules()
    {
        return [
            'customer.first_name' => 'required|string|max:255',
            'customer.last_name' => 'required|string|max:255',
            'customer.number' => 'required|string|max:20',
            'customer.email' => 'required|email|max:255',
            'car.plate' => 'required|string|max:20',
            'car.brand' => 'required|string|max:255',
            'car.model' => 'required|string|max:255',
            'car.color' => 'required|string|max:50',
            'car.year' => 'required|date',
            'car.maintenance_date' => 'required|date',
            'car.inspection_date' => 'required|date',
            'work.work_title' => 'required|string|max:255',
            'work.description' => 'required|string',
            'work.worker_id' => 'required|exists:workers,id',
            'work.price' => 'required|numeric|min:0',
        ];
    }
}
