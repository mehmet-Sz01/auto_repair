<?php

namespace App\Models\RecordOfWork;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = ['first_name', 'last_name', 'number', 'email'];

    public function cars()
    {
        return $this->hasMany(Car::class);
    }
}
