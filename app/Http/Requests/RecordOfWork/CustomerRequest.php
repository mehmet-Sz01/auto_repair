<?php
// app/Http/Requests/CustomerRequest.php

namespace App\Http\Requests\RecordOfWork;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'number' => 'required|string|max:15',
            'email' => 'required|string|email|max:255|unique:customers,email',
        ];
    }
}

