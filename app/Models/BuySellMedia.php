<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use App\Traits\StatusTrait;

class BuySellMedia extends Model
{
    use HasFactory;
    use SoftDeletes;
    use StatusTrait;
}
