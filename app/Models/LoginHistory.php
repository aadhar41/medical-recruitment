<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\StatusTrait;

class LoginHistory extends Model
{
    use HasFactory;
    use StatusTrait;

    protected $table = 'login_histories';
}
