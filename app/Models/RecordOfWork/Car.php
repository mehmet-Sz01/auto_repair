<?php

namespace App\Models\RecordOfWork;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Car extends Model
{
    protected $fillable = ['plate', 'brand', 'model', 'color', 'year', 'maintenance_date', 'inspection_date', 'customer_id'];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function works(): HasMany
    {
        return $this->hasMany(Work::class);
    }
}
