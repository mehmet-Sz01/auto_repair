<?php

namespace App\Models\RecordOfWork;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    protected $fillable = ['first_name', 'last_name', 'number', 'email'];

    public function car(): HasMany
    {
        return $this->hasMany(Car::class);
    }

    public function work(): HasMany
    {
        return $this->hasMany(Work::class);
    }
}
