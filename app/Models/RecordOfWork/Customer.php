<?php

namespace App\Models\RecordOfWork;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = ['first_name', 'last_name', 'number', 'emails'];

    public function car()
    {
        return $this->hasMany(Car::class);
    }

    public function work()
    {
        return $this->hasMany(Work::class);
    }
}
