<?php

namespace App\Models\RecordOfWork;

use App\Models\Worker;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Work extends Model
{
    protected $fillable = ['work_title', 'description', 'worker_id', 'price', 'car_id','customer_id'];


    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    public function worker()
    {
        return $this->belongsTo(Worker::class);
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
