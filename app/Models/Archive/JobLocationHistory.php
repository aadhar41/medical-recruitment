<?php

namespace App\Models\Archive;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobLocationHistory extends Model
{
    use HasFactory;
    protected $connection = 'mysql2';
    protected $table = 'job_location_histories';
}
