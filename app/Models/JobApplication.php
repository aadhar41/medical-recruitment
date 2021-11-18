<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use App\Traits\StatusTrait;
use App\Traits\RoleTrait;

class JobApplication extends Model
{
    use HasFactory;
    use SoftDeletes;
    use StatusTrait;
    use RoleTrait;

    protected $table = 'job_applications';

    protected $fillable = ['job_id', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * Function for eloquent relationship.
     * 
     * @return "returns eloquent relationship"
     */
    public function jobtypedetails()
    {
        return $this->belongsTo('App\Models\JobType', 'job_type')->select("id", "unique_id", "jobtype")->where("status", "1");
    }

    /**
     * Function for eloquent relationship.
     * 
     * @return "returns eloquent relationship"
     */
    public function createdby()
    {
        return $this->belongsTo('App\Models\User', 'user_id')->select("id", "name", "email")->where("status", "1");
    }

    /**
     * Function for eloquent relationship.
     * 
     * @return "returns eloquent relationship"
     */
    public function jobdetails()
    {
        return $this->belongsTo('App\Models\Job', 'job_id')->where("status", "1");
    }
}
