<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\StatusTrait;

class State extends Model
{
    use HasFactory;
    use StatusTrait;

    protected $table = 'states';

    protected $fillable = ['user_id', 'created_at', 'updated_at'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    // protected $dates = ['deleted_at'];

    /**
     * Accessor function 
     * 
     * @return "returns applied ucwords function text"
     */
    public function getNameAttribute($value)
    {
        return ucwords($value);
    }

    /**
     * Accessor function 
     * 
     * @return "returns applied strtoupper function text"
     */
    public function getIso2Attribute($value)
    {
        return strtoupper($value);
    }

    /**
     * Function for eloquent relationship.
     * 
     * @return "returns eloquent relationship"
     */
    public function cities()
    {
        return $this->hasMany('App\Models\City', 'state_id');
    }

    /**
     * Function for eloquent relationship.
     * 
     * @return "returns eloquent relationship"
     */
    public function suburbs()
    {
        return $this->hasMany('App\Models\Suburb', 'state_id');
    }
}
