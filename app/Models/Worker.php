<?php

namespace App\Models;

use App\Models\RecordOfWork\Work;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    protected $table = 'workers';
    protected $fillable = ['worker_name', 'worker_lastname', 'number', 'wage'];

    public function works()
    {
        return $this->hasMany(Work::class);
    }

}
