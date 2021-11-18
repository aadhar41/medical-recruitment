<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\StatusTrait;

class Suburb extends Model
{
    use HasFactory;
    use StatusTrait;

    public $timestamps = false;

    /**
     * Function for eloquent relationship.
     * 
     * @return "returns eloquent relationship"
     */
    public function state()
    {
        return $this->belongsTo('App\Models\State', 'state_id', 'id');
    }

    /**
     * Function for eloquent relationship.
     * 
     * @return "returns eloquent relationship"
     */
    public function buysell()
    {
        return $this->belongsTo('App\Models\BuySell', 'suburb_id', 'id');
    }
}
