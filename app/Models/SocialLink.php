<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\StatusTrait;

class SocialLink extends Model
{
    use HasFactory;
    use StatusTrait;
}
