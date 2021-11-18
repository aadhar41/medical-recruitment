<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\StatusTrait;

class JobType extends Model
{
    use HasFactory;
    use SoftDeletes;
    use StatusTrait;

    protected $table = 'job_types';

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
    public function getJobypeAttribute($value)
    {
        return ucwords($value);
    }
}
