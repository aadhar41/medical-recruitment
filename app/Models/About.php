<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\StatusTrait;


class About extends Model
{
    use HasFactory;
    use StatusTrait;

    /**
     * Function for return url of aboutus image.
     * 
     * @return "returns base_url for aboutus image"
     */
    public function imageurl()
    {
        return url('/images/aboutus/') . "/";
    }
}
