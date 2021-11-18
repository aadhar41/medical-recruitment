<?php

namespace App\Traits;

use App\Models\Brand;
use App\Models\BrandMedia;
use App\Models\BuySell;
use App\Models\BuySellMedia;

trait StatusTrait
{
    public function scopeActive($query)
    {
        return $query->where("status", "1");
    }

    public function scopeInactive($query)
    {
        return $query->where("status", "0");
    }
}
