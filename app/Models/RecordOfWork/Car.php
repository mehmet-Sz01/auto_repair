<?php

namespace App\Models\RecordOfWork;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = ['plate', 'brand', 'model', 'color', 'year', 'maintenance_date', 'inspection_date', 'customer_id'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function works()
    {
        return $this->hasMany(Work::class);
    }
}
