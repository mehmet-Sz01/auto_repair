<?php

namespace App\Models;

use App\Models\RecordOfWork\Work;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    protected $table = 'workers';


    public function works()
    {
        return $this->hasMany(Work::class);
    }

}
