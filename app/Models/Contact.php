<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use App\Traits\StatusTrait;

class Contact extends Model
{
    use HasFactory;
    use SoftDeletes;
    use StatusTrait;

    protected $fillable = ['created_at', 'updated_at'];
}
